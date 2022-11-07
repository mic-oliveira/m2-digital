<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateProduct
{
    use AsAction;

    public function handle(array $data): Product
    {
        DB::beginTransaction();
        try{
            $product = Product::create($data);
            if (array_key_exists('discount_id', $data)) {
                $product->discounts()->sync($data['discount_id']);
            }
            DB::commit();
            return $product;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

    }
}
