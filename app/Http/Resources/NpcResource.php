<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use JsonSerializable;

class NpcResource extends JsonResource
{
    protected $attributes = [
        'set',
        'ai',
        'petdata',
        'drops',
        'teachTo',
        'minions',
    ];

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $resourceCollection = new Collection();
        $resourceCollection->put('_attributes', $this->getAttributes());

        foreach ($this->attributes as $attribute) {
            $data = $this->{$attribute}();
            if (!empty($data)) {
                $resourceCollection->put($attribute, $data);
            }
        }

        return $resourceCollection->toArray();
    }

    public function getAttributes(): array
    {
        $defaultAttributes = [
            'id' => $this->id,
            'name' => $this->name,
        ];
        $attributes = [
            'idTemplate' => $this->idTemplate,
            'title' => $this->title,
        ];
        return array_merge($defaultAttributes, array_diff($attributes, ['']));
    }

    public function set(): array|JsonSerializable|Arrayable|null
    {
        if ($this->sets->isEmpty()) {
            return null;
        }
        return NpcSetsResource::collection($this->sets)->toArray(\request());
    }

    public function ai(): array|JsonSerializable|Arrayable|null
    {
        if ($this->ai->isEmpty()) {
            return null;
        }
        return NpcAiResource::collection($this->ai)->toArray(\request());
    }

    public function skills(): ?array
    {
        if ($this->skills->isEmpty()) {
            return null;
        }
        return ['skill' => NpcSkillResource::collection($this->skills)->toArray(\request())];
    }

    public function petdata(): array|JsonSerializable|Arrayable|null
    {
        if ($this->pets->isEmpty()) {
            return null;
        }
        return NpcPetResource::collection($this->pets)->toArray(\request());
    }

    public function drops(): ?array
    {
        if ($this->drop->isEmpty()) {
            return null;
        }
        return ['category' => DropCategoryResource::collection($this->drop->unique('category'))->toArray(\request())];
    }

    public function teachTo(): array|JsonSerializable|Arrayable|null
    {
        if ($this->teaches->isEmpty()) {
            return null;
        }
        return NpcTeachResource::collection($this->teaches)->toArray(\request());
    }

    public function minions(): ?array
    {
        if ($this->minions->isEmpty()) {
            return null;
        }
        return ['minion' => NpcMinionResource::collection($this->minions)->toArray(\request())];
    }
}
