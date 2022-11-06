<?php

use App\Actions\Discount\CreateDiscount;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should create discount', function ($data, $expected) {
    $result = CreateDiscount::run($data);
    expect($result->name)->toBe($expected);
})->with([
    ['data' => ['name' => 'Desconto teste', 'percentage' => 10], 'Desconto teste'],
    ['data' => ['name' => 'Desconto teste 2', 'percentage' => 10], 'Desconto teste 2'],
]);

test('should not create discounts with same name', function ($data) {
    CreateDiscount::run($data);
    CreateDiscount::run($data);
})->with([
    ['data' => ['name' => 'Belo Horizonte']]
])->throws(Exception::class);

test('should not create discount without a name', function () {
    CreateDiscount::run(['name' => '']);
    CreateDiscount::run(['name' => null]);
})->throws(Exception::class);

test('should not create discount with null param', function () {
    CreateDiscount::run(null);
})->throws(TypeError::class);

test('should create discount with products attached', function ($data) {
    $result = CreateDiscount::run($data);
    expect($result->products()->count())->toBe(3);
})->with([
    ['data' => ['name' => 'Descounto teste 1', 'percentage' => 50, 'products_id' => [1,2,3]]]
])->with([
    fn() => Product::factory(5)->create()
]);
