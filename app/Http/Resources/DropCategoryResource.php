<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DropCategoryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_attributes' => [
                'id' => $this->category,
            ],
            'drop' => DropResource::collection($this->npc->drop()->where('category', $this->category)->get())->toArray($request)
        ];
    }
}
