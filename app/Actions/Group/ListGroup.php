<?php

namespace App\Actions\Group;

use App\Models\Group;
use Illuminate\Contracts\Pagination\Paginator;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListGroup
{
    use AsAction;

    public function handle(?int $per_page = 15): Paginator
    {
        return QueryBuilder::for(Group::class)
            ->allowedIncludes(['cities','campaigns'])
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])->orderBy('id')->paginate($per_page);
    }
}
