<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Npc extends Model
{
    protected $fillable = [
        'id',
        'idTemplate',
        'name',
        'title',
    ];
}
