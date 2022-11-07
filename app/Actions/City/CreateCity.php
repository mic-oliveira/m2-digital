<?php

namespace App\Actions\City;

use App\Models\City;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCity
{
    use AsAction;

    public function handle(array $data)
    {
        DB::beginTransaction();
        try{
            $city = City::create($data);
            if (array_key_exists('group_id', $data)) {
                $city->groups()->attach($data['group_id']);
            }
            DB::commit();
            return $city;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
