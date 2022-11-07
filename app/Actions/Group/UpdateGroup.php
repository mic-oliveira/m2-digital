<?php

namespace App\Actions\Group;

use App\Models\Group;
use Exception;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UpdateGroup
{
    use AsAction;

    /**
     * @throws Exception
     */
    public function handle(array $data, Group $group): Group
    {

        DB::beginTransaction();
        try{
            $group->fill($data)->save();
            if (array_key_exists('cities_id', $data)) {
                $group->cities()->detach($group->cities()->pluck('id')->all());
                $group->citiesBelongToAnotherGroup($data['cities_id']);
                $group->cities()->sync($data['cities_id']);
            }
            if (array_key_exists('campaign_id', $data)) {
                $group->campaigns()->sync($data['campaign_id']);
            }
            DB::commit();
            return $group->refresh();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
