<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NpcSets extends Model
{
    protected $fillable = [
        'id',
        'npc_id',
        'name',
        'val',
    ];
}
