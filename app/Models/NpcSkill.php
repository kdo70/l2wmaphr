<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NpcSkill extends Model
{
    protected $fillable = [
        'id',
        'npc_id',
        'level',
    ];
}
