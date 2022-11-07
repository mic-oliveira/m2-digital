<?php

use App\Actions\Product\CreateProduct;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should create a product', function ($data, $expected) {
    $result = CreateProduct::run($data);
    expect($result->name)->toBe($expected);
})->with([
    ['data' => ['name' => 'Produto teste', 'price' => 200], 'Produto teste'],
    ['data' => ['name' => 'Produto teste 2', 'price' => 450], 'Produto teste 2']
]);

test('should not create product with same name', function ($data) {
    Product::factory()->state(['name' => 'Produto Teste'])->create();
    CreateProduct::run($data);
})->with([
    ['data' => ['name' => 'Produto teste'], 'Produto teste'],
])->throws(Exception::class);


test('should throws exception when products already belong to another discount', function ($data) {
    Product::factory()->has(Discount::factory(3))->create();
    CreateProduct::run($data);
})->with([
    ['data' => ['name' => 'Grupo teste','discount' => [1,2,3]], 'Grupo teste'],
])->throws(Exception::class);

test('should create a product with discount', function ($data, $expected) {
    $result = CreateProduct::run($data);
    expect($result->name)->toBe($expected)->and($result->discounts()
        ->pluck('id')->all())->toContain($data['discount_id']);
})->with([
    ['data' => ['name' => 'Produto teste', 'price' => 200, 'discount_id' => 1], 'Produto teste'],
    ['data' => ['name' => 'Produto teste 2', 'price' => 450, 'discount_id' => 2], 'Produto teste 2']
])->with([
    fn() => Discount::factory(3)->create()
]);

test('should not create a product with not existing discount', function ($data, $expected) {
    CreateProduct::run($data);
})->with([
    ['data' => ['name' => 'Produto teste', 'price' => 200, 'discount_id' => 1], 'Produto teste'],
    ['data' => ['name' => 'Produto teste 2', 'price' => 450, 'discount_id' => 2], 'Produto teste 2']
])->throws(Exception::class);
