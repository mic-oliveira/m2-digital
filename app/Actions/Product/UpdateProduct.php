<?php

namespace App\Actions\Product;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProduct
{
    use AsAction;

    public function handle(array $data, Product $product)
    {
        $product->fill($data)->save();
        return $product->refresh();
    }
}
