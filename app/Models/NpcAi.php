<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
