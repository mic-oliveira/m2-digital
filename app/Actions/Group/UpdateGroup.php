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
            if (!array_key_exists('cities_id', $data)) {
                DB::commit();
                return $group->refresh();
            }
            $group->cities()->detach($group->cities()->pluck('id')->all());
            if (DB::table('cities_groups')->whereIn('city_id', $data['cities_id'])->exists()) {
                throw new UnprocessableEntityHttpException('um elemento de cities_id já pertence a um grupo');
            }
            $group->cities()->sync($data['cities_id']);
            DB::commit();
            return $group->refresh();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
