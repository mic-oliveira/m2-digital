<?php

namespace App\Actions\City;

use App\Models\City;
use Illuminate\Contracts\Pagination\Paginator;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListCity
{
    use AsAction;

    public function handle(?int $per_page = 15): Paginator
    {
        return QueryBuilder::for(City::class)
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])->orderBy('id')->paginate($per_page);
    }
}
