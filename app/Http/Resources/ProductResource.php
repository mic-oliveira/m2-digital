<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProductResource extends JsonResource
{
    use IncludesTrait;

    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'currency_price' => $this->currency_symbol.$this->formatted_price,
            'formatted_price' => $this->formatted_price,
            'currency_discount' => $this->currency_symbol.$this->formatted_discount,
            'formatted_discount' => $this->formatted_discount,
            'currency_symbol' => $this->currency_symbol,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'discount_percent' => $this->discount_percent,
            'discount_value' => $this->discount_value / 100,
            'create_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
