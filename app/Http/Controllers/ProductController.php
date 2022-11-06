<?php

namespace App\Http\Controllers;

use App\Actions\Product\CreateProduct;
use App\Actions\Product\DeleteProduct;
use App\Actions\Product\ListProduct;
use App\Actions\Product\UpdateProduct;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(ListProduct::run(\request()->get('per_page')));
    }

    public function store(Request $request): ProductResource
    {
        return ProductResource::make(CreateProduct::run($request->all()));
    }

    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    public function update(Request $request, Product $product): ProductResource
    {
        return ProductResource::make(UpdateProduct::run($request->all(), $product));
    }

    public function destroy(Product $product): ProductResource
    {
        return ProductResource::make(DeleteProduct::run($product));
    }
}
