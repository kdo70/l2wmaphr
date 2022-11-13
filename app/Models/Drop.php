<?php

namespace App\Models;

use App\Models\NPC\Npc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function npc(): BelongsTo
    {
        return $this->belongsTo(Npc::class, 'npc_id');
    }
}
