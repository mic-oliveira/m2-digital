<?php

namespace App\Actions\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteProduct
{
    use AsAction;

    public function handle(Product $product): Product
    {
        if (!is_null($product->deleted_at)) {
            throw new ModelNotFoundException();
        }
        $product->delete();
        return $product->refresh();
    }
}
