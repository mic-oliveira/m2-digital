<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProduct
{
    use AsAction;

    public function handle(array $data, Product $product)
    {
        DB::beginTransaction();
        try {
            $product->fill($data)->save();
            if (array_key_exists('discount_id', $data)) {
                $product->discounts()->sync($data['discount_id']);
            }
            DB::rollBack();
            return $product->refresh();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
