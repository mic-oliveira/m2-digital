<?php

namespace App\Actions\Discount;

use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateDiscount
{
    use AsAction;

    public function handle(array $data): Discount
    {
        DB::beginTransaction();
        try {
            $discount = Discount::create($data);
            if (array_key_exists('products_id', $data)) {
                $discount->products()->sync($data['products_id']);
            }
            DB::commit();
            return $discount->refresh();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
