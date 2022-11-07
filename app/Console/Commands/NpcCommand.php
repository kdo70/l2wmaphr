<?php

namespace App\Console\Commands;

use App\Models\Npc;
use App\Models\NpcAi;
use App\Models\NpcSets;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class NpcCommand extends Command
{
    protected $signature = 'npc';

    protected $description = 'Command description';

    public function handle()
    {
        Npc::query()->delete();

        $files = Storage::allFiles('npcs');

        foreach ($files as $file) {
            $npcs = $this->prepareNpcData($file);
            $bar = $this->output->createProgressBar(count($npcs));
            $bar->start();
            foreach ($npcs as $npc) {
                $npcModel = $this->createNpc($npc);
                $this->createNpcSet($npc, $npcModel);
                $this->createNpcAi($npc, $npcModel);
                $bar->advance();
            }
            $bar->finish();
        }
    }

    public function createNpc($npc)
    {
        $attributes = Arr::get($npc, '@attributes');
        $this->validateAttribute((new Npc())->getTable(), $attributes);
        return Npc::create(Arr::get($npc, '@attributes'));
    }

    public function createNpcSet($npc, $npcModel)
    {
        $sets = Arr::get($npc, 'set');
        foreach ($sets as $set) {
            $set = current($set);
            $npcSet = array_merge(['npc_id' => $npcModel->id], $set);
            $this->validateAttribute((new NpcSets())->getTable(), $npcSet);
            NpcSets::create($npcSet);
        }
    }

    public function validateAttribute($table, $data)
    {
        foreach ($data as $column => $value) {
            if (!Schema::hasColumn($table, $column)) {
                dd($table, $column);
            }
        }

    }

    public function createNpcAi($npc, $npcModel)
    {
        $ai = current(Arr::get($npc, 'ai'));
        $this->validateAttribute((new NpcAi())->getTable(), $ai);
        NpcAi::create(array_merge(['npc_id' => $npcModel->id], $ai));

    }

    public function prepareNpcData($file)
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
