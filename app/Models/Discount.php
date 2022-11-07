<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class Discount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'discounts';

    protected $fillable = [
        'name',
        'percentage',
        'value'
    ];

    public function productsBelongToAnotherDiscount(array $products_id): bool
    {
        if (DB::table('products_discounts')->whereIn('product_id', $products_id)->exists()) {
            throw new UnprocessableEntityHttpException('um elemento de products_id já pertence a um desconto');
        }
        return true;
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_discounts', 'discount_id', 'product_id');
    }
}
