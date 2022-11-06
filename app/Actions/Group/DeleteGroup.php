<?php

namespace App\Actions\Group;

use App\Models\Group;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteGroup
{
    use AsAction;

    public function handle(Group $group): Group
    {
        if (!is_null($group->deleted_at)) {
            throw new ModelNotFoundException();
        }
        $group->delete();
        $group->cities()->detach($group->cities()->pluck('id')->all());
        return $group->refresh();
    }
}
