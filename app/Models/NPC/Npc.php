<?php

namespace App\Models\NPC;

use App\Models\Drop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use TValue;

/**
 * @method static firstOrCreate(array|TValue[] $all, array|TValue[] $all1)
 * @property mixed $id
 */
class Npc extends Model
{
    protected $fillable = [
        'id',
        'idTemplate',
        'name',
        'title',
    ];

    public function sets(): HasMany
    {
        return $this->hasMany(NpcSets::class, 'npc_id', 'id');
    }

    public function ai(): HasMany
    {
        return $this->hasMany(NpcAi::class, 'npc_id', 'id');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(NpcSkill::class, 'npc_id', 'id');
    }

    public function pets(): HasMany
    {
        return $this->hasMany(NpcPet::class, 'npc_id', 'id');
    }

    public function drop(): HasMany
    {
        return $this->hasMany(Drop::class, 'npc_id', 'id');
    }

    public function teaches(): HasMany
    {
        return $this->hasMany(NpcTeach::class, 'npc_id', 'id');
    }

    public function minions(): HasMany
    {
        return $this->hasMany(NpcMinion::class, 'owner_id', 'id');
    }
}
