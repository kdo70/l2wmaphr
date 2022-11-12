<?php

namespace App\Console\Commands;

use App\Models\Drop;
use App\Models\NPC\Npc;
use App\Models\NPC\NpcAi;
use App\Models\NPC\NpcMinion;
use App\Models\NPC\NpcPet;
use App\Models\NPC\NpcPetStat;
use App\Models\NPC\NpcSets;
use App\Models\NPC\NpcSkill;
use App\Models\NPC\NpcTeach;
use App\Models\Skill;
use ArrayAccess;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * Команда: "Импорт\Экспорт NPC XML\DB"
 */
class NpcCommand extends Command
{
    /**
     * Подпись команды
     * @var string
     */
    protected $signature = 'npc';

    /**
     * Описание команды
     * @var string
     */
    protected $description = 'Импорт\Экспорт NPC XML\DB';

    /**
     * Коллекция схем используемых моделей
     * @var Collection
     */
    protected Collection $schema;

    /**
     * Конструктор
     */
    public function __construct()
    {
        $this->schema = collect([]);
        parent::__construct();
    }

    /**
     * Обработчик
     * @return void
     */
    public function handle()
    {
        Npc::query()->delete();

        $files = Storage::allFiles('npc');

        $this->insertNpcData($files);
        $this->insertNpcMinions($files);
    }

    /**
     * Записать основную информацию о NPC
     * @param array $files Набор XML файлов NPC
     * @return void
     */
    public function insertNpcData(array $files)
    {
        foreach ($files as $file) {
            $npcItems = $this->prepareNpcData($file);

            $bar = $this->output->createProgressBar(count($npcItems));
            $bar->start();
            foreach ($npcItems as $npc) {
                $npcModel = $this->getNpc($npc);

                $this->createNpcSets($npc, $npcModel);
                $this->createNpcAi($npc, $npcModel);
                $this->createNpcSkills($npc, $npcModel);
                $this->createNpcPets($npc, $npcModel);
                $this->createNpcDrops($npc, $npcModel);
                $this->createTeachClasses($npc, $npcModel);

                $bar->advance();
            }
            $bar->finish();
        }
    }

    /**
     * Записать информацию о миньонах
     * @param array $files Набор XML файлов NPC
     * @return void
     */
    public function insertNpcMinions(array $files)
    {
        foreach ($files as $file) {
            $npcItems = $this->prepareNpcData($file);

            $bar = $this->output->createProgressBar(count($npcItems));
            $bar->start();
            foreach ($npcItems as $npc) {
                $npcModel = $this->getNpc($npc);

                $this->createNpcMinions($npc, $npcModel);

                $bar->advance();
            }
            $bar->finish();
        }
    }

    /**
     * Получить модель NPC
     * @param array $npc данные NPC
     * @return Npc
     */
    public function getNpc(array $npc): Npc
    {
        $attributes = Arr::get($npc, '@attributes');
        $this->validateAttribute((new Npc())->getTable(), $attributes);
        $npcData = collect(Arr::get($npc, '@attributes'));
        return Npc::firstOrCreate($npcData->only('id')->all(), $npcData->all());
    }

    /**
     * Записать параметры NPC
     * @param array $npc данные NPC
     * @param Npc $npcModel Модель
     * @return void
     */
    public function createNpcSets(array $npc, Npc $npcModel)
    {
        $sets = Arr::get($npc, 'set');
        $npcSets = collect([]);
        foreach ($sets as $set) {
            $set = current($set);
            $npcSet = array_merge(['npc_id' => $npcModel->id], $set);
            $this->validateAttribute((new NpcSets())->getTable(), $npcSet);
            $npcSets->add($npcSet);
        }
        NpcSets::insert($npcSets->all());
    }

    /**
     * Валидация атрибутов модели, по схеме
     * @param string $table Таблица
     * @param array $data Набор данных
     * @return void
     */
    public function validateAttribute(string $table, array $data)
    {
        if (!$this->schema->get($table)) {
            $this->schema->put($table, collect(Schema::getColumnListing($table)));
        }
        $schema = $this->schema->get($table);
        collect(array_keys($data))->map(function ($item) use ($schema, $table, $data) {
            if (!$schema->contains($item)) {
                dd($table, $data, $schema);
            }
        });
    }

    /**
     * Записать AI NPC
     * @param array $npc данные NPC
     * @param Npc $npcModel Модель
     * @return void
     */
    public function createNpcAi(array $npc, Npc $npcModel)
    {
        $ai = current(Arr::get($npc, 'ai'));
        $this->validateAttribute((new NpcAi())->getTable(), $ai);
        NpcAi::create(array_merge(['npc_id' => $npcModel->id], $ai));
    }

    /**
     * Записать умения NPC
     * @param array $npc данные NPC
     * @param Npc $npcModel Модель
     * @return void
     */
    public function createNpcSkills(array $npc, Npc $npcModel)
    {
        $skills = Arr::get($npc, 'skills.skill');
        if (Arr::exists($skills, '@attributes')) {
            $skills = [$skills];
        }
        $npcSkills = collect([]);
        foreach ($skills as $skill) {
            $skill = Arr::get($skill, '@attributes');
            $this->validateAttribute((new NpcSkill())->getTable(), $skill);
            $skillModel = Skill::firstOrCreate(collect($skill)->only('id')->all());
            $skillData = Arr::add(collect($skill)->only('level')->all(), 'skill_id', $skillModel->id);
            $skillData = Arr::add($skillData, 'npc_id', $npcModel->id);
            $npcSkills->add($skillData);
        }
        NpcSkill::insert($npcSkills->all());
    }

    /**
     * Записать данные о питомцах NPC
     * @param array $npc данные NPC
     * @param Npc $npcModel Модель
     * @return void
     */
    public function createNpcPets(array $npc, Npc $npcModel)
    {
        $petData = Arr::get($npc, 'petdata');
        $pet = Arr::get($petData, '@attributes');
        if (empty($pet)) {
            return;
        }
        $this->validateAttribute((new NpcPet())->getTable(), $pet);
        $petModel = NpcPet::create(array_merge($pet, ['npc_id' => $npcModel->id]));
        $petStatData = Arr::get($petData, 'stat');
        $petStatDataCollect = collect([]);
        foreach ($petStatData as $petStat) {
            $petStat = Arr::get($petStat, '@attributes');
            $this->validateAttribute((new NpcPetStat())->getTable(), $petStat);
            $petStatDataCollect->add(array_merge($petStat, ['npc_pet_id' => $petModel->id]));
        }
        NpcPetStat::insert($petStatDataCollect->all());
    }

    /**
     * Записать данные о дропе предметов NPC
     * @param array $npc данные NPC
     * @param Npc $npcModel Модель
     * @return void
     */
    public function createNpcDrops(array $npc, Npc $npcModel)
    {
        $dropData = Arr::get($npc, 'drops.category');
        if (empty($dropData)) {
            return;
        }

        if (Arr::exists($dropData, '@attributes')) {
            $dropData = [$dropData];
        }

        $dropCollection = collect([]);
        foreach ($dropData as $drops) {
            $category = Arr::get($drops, '@attributes.id');
            $drops = Arr::get($drops, 'drop');

            if (Arr::exists($drops, '@attributes')) {
                $drops = [$drops];
            }

            foreach ($drops as $drop) {
                $drop = Arr::get($drop, '@attributes');
                $this->validateAttribute((new Drop())->getTable(), $drop);
                $dropCollection->add(array_merge($drop, ['category' => $category, 'npc_id' => $npcModel->id]));
            }
        }
        Drop::insert($dropCollection->all());
    }

    /**
     * Записать данные о миньонах NPC
     * @param array $npc данные NPC
     * @param Npc $npcModel Модель
     * @return void
     */
    public function createNpcMinions(array $npc, Npc $npcModel)
    {
        $minionsData = Arr::get($npc, 'minions');
        if (!empty($minionsData)) {
            $minionsData = Arr::get($minionsData, 'minion');
            if (Arr::get($minionsData, '@attributes')) {
                $minionsData = [$minionsData];
            }
            $minions = collect([]);
            foreach ($minionsData as $minion) {
                $minion = Arr::get($minion, '@attributes');
                $minionId = Arr::get($minion, 'id');
                $minion = Arr::only($minion, ['min', 'max']);
                $minion = array_merge($minion, ['npc_id' => $minionId, 'owner_id' => $npcModel->id]);
                $this->validateAttribute((new NpcMinion())->getTable(), $minion);
                $minions->add($minion);
            }
            NpcMinion::insert($minions->all());
        }
    }

    /**
     * Записать данные об обучаемых классах NPC
     * @param array $npc данные NPC
     * @param Npc $npcModel Модель
     * @return void
     */
    public function createTeachClasses(array $npc, Npc $npcModel)
    {
        $teachData = Arr::get($npc, 'teachTo');
        if (!empty($teachData)) {
            $teachData = Arr::get($teachData, '@attributes');
            $this->validateAttribute((new NpcTeach())->getTable(), $teachData);
            NpcTeach::insert(array_merge($teachData, ['npc_id' => $npcModel->id]));
        }
    }

    /**
     * Подготовить файл для чтения
     * @param string $file Путь до файла
     * @return array|ArrayAccess|mixed
     */
    public function prepareNpcData(string $file): mixed
    {
        $storagePath = storage_path('app\\' . $file);
        $filePath = str_replace("/", "\\", $storagePath);
        $content = File::get($filePath);
        $xml = simplexml_load_string($content);
        $json = json_encode($xml);
        $array = json_decode($json, true);
        return Arr::get($array, 'npc');
    }
}
