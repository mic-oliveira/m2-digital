<?php

use App\Actions\Discount\UpdateDiscount;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should update discount', function ($data, Discount $discount) {
    $result = UpdateDiscount::run($data, $discount);
    expect($result->name)->toBe($data['name']);
})->with([
    ['data' => ['name' => 'Nome atualizado']],
    ['data' => ['name' => 'Nome atualizado 2']],
])->with([fn() => Discount::factory()->create()]);

test('should update products attached to discount', function ($data, Discount $discount) {
    $result = UpdateDiscount::run($data, $discount);
    expect($result->products()->count())->toBe(1);
})->with([
    ['data' => ['products_id' => [1]]],
    ['data' => ['products_id' => [4]]],
])->with([fn() => Discount::factory()->has(Product::factory(5), 'products')->create()]);

test('should not update products if alredy belong to another discount', function ($data, Discount $discount) {
    UpdateDiscount::run($data, $discount);
})->with([
    ['data' => ['products_id' => [2]]],
    ['data' => ['products_id' => [1,3]]],
])->with([
    fn() => Discount::factory()->has(Product::factory(1), 'products')->create()
])->with([
    fn() => Discount::factory()->has(Product::factory(3), 'products')->create()
])->throws(Exception::class);
