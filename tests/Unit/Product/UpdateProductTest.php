<?php

use App\Actions\Product\UpdateProduct;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should update product', function ($data, Product $product) {
    $result = UpdateProduct::run($data, $product);
    expect($result->name)->toBe($data['name']);
})->with([
    ['data' => ['name' => 'Nome atualizado']],
    ['data' => ['name' => 'Nome atualizado 2']],
])->with([fn() => Product::factory()->create()]);

test('should update product with discount', function ($data, Product $product) {
    $result = UpdateProduct::run($data, $product);
    expect($result->name)->toBe($data['name'])
        ->and($result->discounts()->pluck('id')->all())
        ->toContain($data['discount_id']);
})->with([
    ['data' => ['name' => 'Nome atualizado', 'discount_id' => 2]],
    ['data' => ['name' => 'Nome atualizado 2', 'discount_id' => 1]],
])->with([
    fn() => Product::factory()->create()
])->with([
    fn() => Discount::factory(2)->create()
]);


