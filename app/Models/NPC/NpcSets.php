<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array|\TValue[] $all)
 */
class NpcSets extends Model
{
    protected $fillable = [
        'id',
        'npc_id',
        'name',
        'val',
    ];
}
