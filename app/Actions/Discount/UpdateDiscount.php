<?php

namespace App\Actions\Discount;

use App\Models\Discount;
use Exception;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UpdateDiscount
{
    use AsAction;

    /**
     * @throws Exception
     */
    public function handle(array $data, Discount $discount): Discount
    {
        DB::beginTransaction();
        try{
            $discount->fill($data)->save();
            if (!array_key_exists('products_id', $data)) {
                DB::commit();
                return $discount->refresh();
            }
            $discount->products()->detach($discount->products()->pluck('id')->all());
            if (DB::table('products_discounts')->whereIn('product_id', $data['products_id'])->exists()) {
                throw new UnprocessableEntityHttpException('um elemento de products_id já pertence a um desconto');
            }
            $discount->products()->sync($data['products_id']);
            DB::commit();
            return $discount->refresh();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
