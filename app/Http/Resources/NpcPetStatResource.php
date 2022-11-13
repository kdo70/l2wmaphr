<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NpcPetStatResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_attributes' => $this->getAttributes(),
        ];
    }

    public function getAttributes()
    {
        $attributes = [
            'level' => $this->level,
            'maxMeal' => $this->maxMeal,
            'exp' => $this->exp,
            'expType' => $this->expType,
            'mealInBattle' => $this->mealInBattle,
            'mealInNormal' => $this->mealInNormal,
            'pAtk' => $this->pAtk,
            'pDef' => $this->pDef,
            'mAtk' => $this->mAtk,
            'mDef' => $this->mDef,
            'hp' => $this->hp,
            'mp' => $this->mp,
            'hpRegen' => $this->hpRegen,
            'mpRegen' => $this->mpRegen,
            'mealInBattleOnRide' => $this->mealInBattleOnRide,
            'mealInNormalOnRide' => $this->mealInNormalOnRide,
            'speedOnRide' => $this->speedOnRide,
            'atkSpdOnRide' => $this->atkSpdOnRide,
            'pAtkOnRide' => $this->pAtkOnRide,
            'mAtkOnRide' => $this->mAtkOnRide,
            'ssCount' => $this->ssCount,
            'spsCount' => $this->spsCount,
        ];
        return array_diff($attributes, ['']);
    }
}
