<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_discounts', 'discount_id', 'product_id');
    }
}
