<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NpcMinionResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_attributes' => [
                'id' => $this->npc_id,
                'min' => $this->min,
                'max' => $this->max,
            ],
        ];
    }
}
