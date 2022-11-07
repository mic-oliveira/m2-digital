<?php

namespace App\Actions\Campaign;

use App\Models\Campaign;
use Illuminate\Contracts\Pagination\Paginator;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\QueryBuilder;

class ListCampaign
{
    use AsAction;

    public function handle(?int $per_page = 15): Paginator
    {
        return QueryBuilder::for(Campaign::class)
            ->allowedIncludes(
                AllowedInclude::relationship('groups'),
                AllowedInclude::relationship('products')
            )
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])
            ->orderBy('id')->paginate($per_page);
    }
}
