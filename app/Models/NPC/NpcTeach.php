<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array|\ArrayAccess $array_merge)
 */
class NpcTeach extends Model
{
    protected $fillable = [
        'npc_id',
        'classes',
    ];
}
