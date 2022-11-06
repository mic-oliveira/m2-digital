<?php

namespace App\Actions\Product;

use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteProduct
{
    use AsAction;

    public function handle(Product $product): Product
    {
        $product->delete();
        return $product->refresh();
    }
}
