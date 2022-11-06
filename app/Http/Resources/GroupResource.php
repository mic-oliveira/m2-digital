<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class GroupResource extends JsonResource
{
    use IncludesTrait;

    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $includes = array_flip(explode(',', $request->query('include')));
        return [
            'id' => $this->id,
            'name' => $this->name,
            $this->mergeWhen(
                array_key_exists('cities', $includes), ['cities' => CityResource::collection($this->cities)]
            ),
            $this->mergeWhen(
                array_key_exists('campaigns', $includes), ['campaigns' => CityResource::collection($this->campaigns)]
            ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
