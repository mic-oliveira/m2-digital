<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    use IncludesTrait;

    public function toArray($request): array|\JsonSerializable|Arrayable
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status->value,
            'description' => $this->description,
            $this->mergeWhen($this->includes('groups'), ['groups' => GroupResource::collection($this->groups)]),
            $this
                ->mergeWhen($this->includes('products'), ['products' => ProductResource::collection($this->products)]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
