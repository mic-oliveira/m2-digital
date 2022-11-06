<?php

use App\Actions\City\CreateCity;
use App\Actions\Discount\CreateDiscount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should create discount', function ($data, $expected) {
    $result = CreateDiscount::run($data);
    expect($result->name)->toBe($expected);
})->with([
    ['data' => ['name' => 'Desconto teste', 'percentage' => 10], 'Belo Horizonte'],
    ['data' => ['name' => 'Fortaleza', 'percentage' => 10], 'Fortaleza'],
]);

test('should not create discounts with same name', function ($data) {
    CreateDiscount::run($data);
    CreateDiscount::run($data);
})->with([
    ['data' => ['name' => 'Belo Horizonte']]
])->throws(Exception::class);

test('should not create city without a name', function () {
    CreateDiscount::run(['name' => '']);
    CreateDiscount::run(['name' => null]);
})->throws(Exception::class);

test('should not create city with null param', function () {
    CreateDiscount::run(null);
})->throws(TypeError::class);
