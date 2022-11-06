<?php

namespace App\Actions\Discount;

use App\Models\Discount;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteDiscount
{
    use AsAction;

    public function handle(Discount $discount): Discount
    {
        if (!is_null($discount->deleted_at)) {
            throw new ModelNotFoundException();
        }
        $discount->delete();
        $discount->products()->detach($discount->products()->pluck('id')->toArray());
        return $discount->refresh();
    }
}
