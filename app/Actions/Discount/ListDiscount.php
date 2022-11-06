<?php

namespace App\Actions\Discount;

use App\Models\Discount;
use Illuminate\Contracts\Pagination\Paginator;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListDiscount
{
    use AsAction;

    public function handle(?int $per_page = 15): Paginator
    {
        return QueryBuilder::for(Discount::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('description')
            ])->orderBy('id')->paginate($per_page);
    }
}
