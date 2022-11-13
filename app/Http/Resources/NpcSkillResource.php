<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NpcSkillResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_attributes' => [
                'id' => $this->skill_id,
                'level' => $this->level,
            ],
        ];
    }
}
