<?php

namespace App\Console\Commands;

use App\Models\Drop;
use App\Models\NPC\Npc;
use Illuminate\Console\Command;

class NpcModifyCommand extends Command
{
    /**
     * Подпись команды
     * @var string
     */
    protected $signature = 'npc:modify';

    /**
     * Описание команды
     * @var string
     */
    protected $description = 'Импорт npc xml to database';

    /**
     * Обработчик
     * @return void
     */
    public function handle()
    {
        /*        $drop = Drop::query()->where('itemid', '!=', 57)->delete();
                foreach (Drop::all() as $drop) {
                    $drop->update(['min' => round($drop->min / 2), 'max' => round($drop->max / 2), 'chance' => '50000']);
                }*/

        /*Drop::query()->where('itemid', '!=', 57)->delete();
        $npcItems = Npc::query()->whereRelation('sets', 'val', 'Monster')->get();
        foreach ($npcItems as $npc) {
            //1 000000
            //100 000
            //10 000
            $exp = $npc->sets->where('name', 'exp')->first()->val;
            $mul = 10000 + rand(0, 10000);
            $maxChance = 73665 + $mul;
            $chance = min($exp, $maxChance) + $mul;
            if (!empty($exp)) {
                $npc->drop()->save(new Drop(['category' => 0, 'itemid' => 4356, 'min' => 1, 'max' => 1, 'chance' => $chance]));
            }
        }*/
        $drop = Drop::query()->whereNotIn('itemid', [4356, 57])->delete();
        $npc = Npc::query()->where('id', 20458)->first();

        for ($i = 0; $i <= 100; $i++) {
            $npc->drop()->save(new Drop(['category' => rand(-1, 5), 'itemid' => 4356, 'min' => rand(1, 1000), 'max' => rand(1000, 10000), 'chance' => rand(10000, 100000)]));
        }
    }
}
