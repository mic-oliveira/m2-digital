<?php

namespace App\Actions\Campaign;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCampaign
{
    use AsAction;

    public function handle(Campaign $campaign): Campaign
    {
        if (!is_null($campaign->deleted_at)) {
            throw new ModelNotFoundException();
        }
        $campaign->delete();
        $campaign->groups()->detach($campaign->groups()->pluck('id')->all());
        $campaign->products()->detach($campaign->products()->pluck('id')->all());
        return $campaign->refresh();
    }
}
