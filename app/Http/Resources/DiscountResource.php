<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    use IncludesTrait;

    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'percentage' => $this->percentage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
