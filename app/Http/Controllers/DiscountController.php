<?php

namespace App\Http\Controllers;

use App\Actions\Discount\CreateDiscount;
use App\Actions\Discount\DeleteDiscount;
use App\Actions\Discount\ListDiscount;
use App\Actions\Discount\UpdateDiscount;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DiscountController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return DiscountResource::collection(ListDiscount::run(\request()->get('per_page')));
    }


    public function store(StoreDiscountRequest $request): DiscountResource
    {
        return DiscountResource::make(CreateDiscount::run($request->validated()));
    }

    public function show(Discount $discount): DiscountResource
    {
        return DiscountResource::make($discount);
    }

    public function update(UpdateDiscountRequest $request, Discount $discount): DiscountResource
    {
        return DiscountResource::make(UpdateDiscount::run($request->validated(), $discount));
    }

    public function destroy(Discount $discount): DiscountResource
    {
        return DiscountResource::make(DeleteDiscount::run($discount));
    }
}
