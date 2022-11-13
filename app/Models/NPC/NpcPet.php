<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function stats(): HasMany
    {
        return $this->hasMany(NpcPetStat::class, 'npc_pet_id', 'id');
    }
}
