<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array|\TValue[] $all)
 */
class NpcSkill extends Model
{
    protected $fillable = [
        'id',
        'npc_id',
        'level',
    ];
}
