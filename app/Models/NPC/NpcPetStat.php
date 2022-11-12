<?php

namespace App\Models\NPC;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array|\TValue[] $all)
 */
class NpcPetStat extends Model
{
    protected $fillable = [
        'npc_pet_id',
        'level',
        'maxMeal',
        'exp',
        'expType',
        'mealInBattle',
        'mealInNormal',
        'pAtk',
        'pDef',
        'mAtk',
        'mDef',
        'hp',
        'mp',
        'hpRegen',
        'mpRegen',
        'mealInBattleOnRide',
        'mealInNormalOnRide',
        'speedOnRide',
        'atkSpdOnRide',
        'pAtkOnRide',
        'mAtkOnRide',
        'ssCount',
        'spsCount',
    ];
}
