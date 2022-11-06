<?php

namespace App\Actions\Discount;

use App\Models\Discount;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateDiscount
{
    use AsAction;

    public function handle(array $data, Discount $discount)
    {
        $discount->fill($data)->save();
        return $discount->refresh();
    }
}
