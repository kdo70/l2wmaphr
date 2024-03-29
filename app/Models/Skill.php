<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель - "Умение"
 * @method static firstOrCreate(array|\TValue[] $all)
 */
class Skill extends Model
{
    /**
     * Атрибуты доступные для загрузки
     * @var string[]
     */
    protected $fillable = [
        'id',
    ];
}
