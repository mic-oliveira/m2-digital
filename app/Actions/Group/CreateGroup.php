<?php

namespace App\Actions\Group;

use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateGroup
{
    use AsAction;

    /**
     * @throws \Exception
     */
    public function handle(array $data): Group
    {
        DB::beginTransaction();
        try{
            $group = Group::create($data);
            if (array_key_exists('cities_id', $data)) {
                $group->cities()->attach($data['cities_id']);
            }
            if (array_key_exists('campaign_id', $data)) {
                $group->campaigns()->sync($data['campaign_id']);
            }
            DB::commit();
            return $group->refresh();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
