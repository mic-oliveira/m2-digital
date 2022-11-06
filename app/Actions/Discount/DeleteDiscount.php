<?php

namespace App\Actions\Discount;

use App\Models\Campaign;
use App\Models\Discount;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteDiscount
{
    use AsAction;

    public function handle(Discount $discount): Discount
    {
        $discount->delete();
        $discount->products()->detach($discount->products()->pluck('id')->toArray());
        return $discount->refresh();
    }
}
