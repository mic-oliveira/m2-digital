<?php

namespace App\Actions\Group;

use App\Models\Group;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteGroup
{
    use AsAction;

    public function handle(Group $group): Group
    {
        $group->delete();
        $group->cities()->detach($group->cities()->pluck('id')->all());
        return $group->refresh();
    }
}
