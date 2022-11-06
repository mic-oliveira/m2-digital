<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CityResource extends JsonResource
{
    use IncludesTrait;

    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            $this->mergeWhen($this->includes('groups'), ['group' => $this->groups->last()]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
