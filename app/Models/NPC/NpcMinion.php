<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array|\TValue[] $all)
 */
class NpcMinion extends Model
{
    protected $fillable = [
        'npc_id',
        'owner_id',
        'min',
        'max'
    ];
}
