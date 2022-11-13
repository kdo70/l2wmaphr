<?php

namespace App\Console\Commands;

use App\Http\Resources\NpcResource;
use App\Models\NPC\Npc;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * Команда: "Экспорт npc xml to database"
 */
class NpcExportCommand extends Command
{
    /**
     * Подпись команды
     * @var string
     */
    protected $signature = 'npc:export';

    /**
     * Описание команды
     * @var string
     */
    protected $description = 'Экспорт npc database to xml';

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
        $npc = Npc::query()->with([
            'sets',
            'ai',
            'skills',
            'pets.stats',
            'drop',
            'teaches',
            'minions',
        ])->orderBy('id')->get();

        $bar = $this->output->createProgressBar($npc->chunk(250)->count());
        $bar->start();

        foreach ($npc->chunk(250) as $chunk) {
            $fileName = $chunk->first()->id . '-' . $chunk->last()->id;

            $array = ['npc' => NpcResource::collection($chunk)->toArray(request())];
            $result = ArrayToXml::convert($array, [
                'rootElementName' => 'list',
            ]);

            File::put(storage_path('app\npc_export\\' . $fileName . '.xml'), $result);

            $bar->advance();
        }
        $bar->finish();
    }
}
