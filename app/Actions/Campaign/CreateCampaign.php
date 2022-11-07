<?php

namespace App\Actions\Campaign;

use App\Models\Campaign;
use Exception;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCampaign
{
    use AsAction;

    /**
     * @throws Exception
     */
    public function handle(array $data): Campaign
    {
        DB::beginTransaction();
        try{
            $campaign = Campaign::create($data);
            if (array_key_exists('groups_id', $data)) {
                $campaign->groups()->sync($data['groups_id']);
            }
            if (array_key_exists('products_id', $data)) {
                $campaign->products()->sync($data['products_id']);
            }
            DB::commit();
            return $campaign->refresh();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
