<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NpcPetResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_attributes' => [
                'food1' => $this->food1,
                'food2' => $this->food2,
                'autoFeedLimit' => $this->autoFeedLimit,
                'hungryLimit' => $this->hungryLimit,
                'unsummonLimit' => $this->unsummonLimit,
            ],
            'stat' => NpcPetStatResource::collection($this->stats)->toArray($request),
        ];
    }
}
