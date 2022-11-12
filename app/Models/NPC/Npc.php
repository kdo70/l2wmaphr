<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static firstOrCreate(array|\TValue[] $all, array|\TValue[] $all1)
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
}
