<?php

namespace App\Actions\City;

use App\Models\City;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCity
{
    use AsAction;

    public function handle($data, City $city): City
    {
        $city->fill($data)->save();
        return $city->refresh();
    }
}
