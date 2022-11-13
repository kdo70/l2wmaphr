<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DropResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_attributes' => [
                'itemid' => $this->itemid,
                'min' => $this->min,
                'max' => $this->max,
                'chance' => $this->chance,
            ],
        ];
    }
}
