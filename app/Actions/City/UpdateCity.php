<?php

namespace App\Actions\City;

use App\Models\City;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCity
{
    use AsAction;

    public function handle($data, City $city): City
    {
        DB::beginTransaction();
        try{
            $city->fill($data)->save();
            if (array_key_exists('group_id', $data)) {
                $city->groups()->sync($data['group_id']);
            }
            DB::commit();
            return $city->refresh();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
