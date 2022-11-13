<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NpcAiResource extends JsonResource
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
            'type' => $this->type,
            'ssCount' => $this->ssCount,
            'ssRate' => $this->ssRate,
            'spsCount' => $this->spsCount,
            'spsRate' => $this->spsRate,
            'aggro' => $this->aggro,
            'clan' => $this->clan,
            'clanRange' => $this->clanRange,
            'ignoredIds' => $this->ignoredIds,
            'canMove' => $this->canMove,
            'seedable' => $this->seedable,
        ];
        return array_diff($attributes, ['']);
    }
}
