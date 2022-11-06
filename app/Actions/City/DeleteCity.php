<?php

namespace App\Actions\City;

use App\Models\City;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCity
{
    use AsAction;

    public function handle(City $city): City
    {
        if (!is_null($city->deleted_at)) {
            throw new ModelNotFoundException();
        }
        $city->delete();
        return $city->refresh();
    }
}
