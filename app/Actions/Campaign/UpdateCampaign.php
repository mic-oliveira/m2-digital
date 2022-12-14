<?php

namespace App\Actions\Campaign;

use App\Models\Campaign;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UpdateCampaign
{
    use AsAction;

    public function handle($data, Campaign $campaign): Campaign
    {
        DB::beginTransaction();
        try{
            $campaign->fill($data)->save();
            if (array_key_exists('groups_id', $data)) {
                $campaign->groups()->detach($campaign->groups()->pluck('id')->all());
                if (DB::table('groups_campaigns')->whereIn('group_id', $data['groups_id'])->exists()) {
                    throw new UnprocessableEntityHttpException('um elemento de groups_id já pertence a um grupo');
                }
                $campaign->groups()->sync($data['groups_id']);
            }
            if (array_key_exists('products_id', $data)) {
                $campaign->products()->sync($data['products_id']);
            }
            DB::commit();
            return $campaign->refresh();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
