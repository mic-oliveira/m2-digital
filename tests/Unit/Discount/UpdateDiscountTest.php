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
