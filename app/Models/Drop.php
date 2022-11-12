<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель - "Дроп"
 * @method static insert(array|\TValue[] $all)
 */
class Drop extends Model
{
    /**
     * Атрибуты доступные для загрузки
     * @var string[]
     */
    protected $fillable = [
        'npc_id',
        'category',
        'itemid',
        'min',
        'max',
        'chance',
    ];
}
