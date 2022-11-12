<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array|\ArrayAccess $array_merge)
 */
class NpcPet extends Model
{
    protected $fillable = [
        'npc_id',
        'food1',
        'food2',
        'autoFeedLimit',
        'hungryLimit',
        'unsummonLimit',
    ];
}
