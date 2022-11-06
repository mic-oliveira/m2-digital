<?php

use App\Actions\Group\CreateGroup;
use App\Actions\Product\CreateProduct;
use App\Models\City;
use App\Models\Group;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should create a group', function ($data, $expected) {
    $result = CreateProduct::run($data);
    expect($result->name)->toBe($expected);
})->with([
    ['data' => ['name' => 'Produto teste', 'price' => 200], 'Produto teste'],
    ['data' => ['name' => 'Produto teste 2', 'price' => 450], 'Produto teste 2']
]);

test('should not create group with same name', function ($data) {
    Product::factory()->state(['name' => 'Produto Teste'])->create();
    CreateProduct::run($data);
})->with([
    ['data' => ['name' => 'Produto teste'], 'Produto teste'],
])->throws(Exception::class);


test('should throws exception when cities already belong to another group', function ($data) {
    Product::factory()->has(City::factory(2))->create();
    CreateProduct::run($data);
})->with([
    ['data' => ['name' => 'Grupo teste','cities_id' => [1,2,3]], 'Grupo teste'],
])->throws(Exception::class);
