<?php

namespace App\Http\Controllers;

use App\Actions\Group\CreateGroup;
use App\Actions\Group\DeleteGroup;
use App\Actions\Group\ListGroup;
use App\Actions\Group\UpdateGroup;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return GroupResource::collection(ListGroup::run(\request()->get('per_page')));
    }

    public function store(StoreGroupRequest $request): GroupResource
    {
        return GroupResource::make(CreateGroup::run($request->validated()));
    }

    public function show(Group $group): GroupResource
    {
        return GroupResource::make($group);
    }

    public function update(UpdateGroupRequest $request, Group $group): GroupResource
    {
        return GroupResource::make(UpdateGroup::run($request->validated(), $group));
    }

    public function destroy(Group $group): GroupResource
    {
        return GroupResource::make(DeleteGroup::run($group));
    }
}
