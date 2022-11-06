<?php

use App\Actions\City\CreateCity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should create city', function ($data, $expected) {
    $result = CreateCity::run($data);
    expect($result->name)->toBe($expected);
})->with([
    ['data' => ['name' => 'Belo Horizonte'], 'Belo Horizonte'],
    ['data' => ['name' => 'Fortaleza'], 'Fortaleza'],
]);

test('should not create cities with same name', function ($data) {
    CreateCity::run($data);
    CreateCity::run($data);
})->with([
    ['data' => ['name' => 'Belo Horizonte']]
])->throws(Exception::class);

test('should not create city without a name', function () {
    CreateCity::run(['name' => '']);
    CreateCity::run(['name' => null]);
})->throws(Exception::class);

test('should not create city with null param', function () {
    CreateCity::run(null);
})->throws(TypeError::class);
