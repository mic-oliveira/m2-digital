<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use NumberFormatter;
use function Pest\Laravel\get;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function discountPercent(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->discounts->last() ? $this->discounts->last()->percentage : 0
        );
    }

    public function discountValue(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (int)ceil($this->original['price'] * ($this->discount_percent/100))
        );
    }

    public function discountPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (int)(floor($this->original['price'] - $this->discount_value)) / 100
        );
    }

    public function formattedPrice(): Attribute
    {
        $numberFormat = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);
        $numberFormat->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
        $numberFormat->setPattern('###,###,###.##');
        $formattedPrice = $numberFormat->format($this->original['price'] / 100);
        return Attribute::make(
            get: fn($value) => $formattedPrice,
        );
    }

    public function formattedDiscount(): Attribute
    {
        $numberFormat = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);
        $numberFormat->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
        $numberFormat->setPattern('###,###,###.##');
        $formattedPrice = $numberFormat->format($this->discount_value / 100);
        return Attribute::make(
            get: fn($value) => $formattedPrice,
        );
    }

    public function currencySymbol(): Attribute
    {
        $numberFormat = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);

        return Attribute::make(
            get: fn($value) => $numberFormat->getSymbol(NumberFormatter::CURRENCY_SYMBOL),
        );
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->original['price'] / 100,
            set: fn($value) => $this->attributes['price'] = $value * 100,
        );
    }

    public function discounts(): BelongsToMany
    {
        return $this
            ->belongsToMany(Discount::class, 'products_discounts', 'product_id', 'discount_id');
    }
}
