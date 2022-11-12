<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array|false $array_merge)
 */
class NpcAi extends Model
{
    protected $table = 'npc_ai';
    protected $fillable = [
        'npc_id',
        'type',
        'ssCount',
        'ssRate',
        'spsCount',
        'spsRate',
        'aggro',
        'clan',
        'clanRange',
        'ignoredIds',
        'canMove',
        'seedable',
    ];
}
