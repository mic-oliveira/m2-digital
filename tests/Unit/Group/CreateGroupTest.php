<?php

use App\Actions\Group\CreateGroup;
use App\Models\City;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should create a group', function ($data, $expected) {
    $result = CreateGroup::run($data);
    expect($result->name)->toBe($expected);
})->with([
    ['data' => ['name' => 'Grupo teste'], 'Grupo teste'],
    ['data' => ['name' => 'Grupo teste 2'], 'Grupo teste 2']
]);

test('should not create group with same name', function ($data) {
    Group::factory()->state(['name' => 'Grupo Teste'])->create();
    CreateGroup::run($data);
})->with([
    ['data' => ['name' => 'Grupo teste','cities_id' => [1,2,3]], 'Grupo teste'],
])->throws(Exception::class);

test('should create a group and attach cities to group', function ($data, $expected) {
    $result = CreateGroup::run($data);
    expect($result->name)->toBe($expected)
        ->and($result->cities()->pluck('id')->all())->toBe($data['cities_id']);
})->with([
    ['data' => ['name' => 'Grupo teste','cities_id' => [1,2,3]], 'Grupo teste'],
])->with([
    fn() => City::factory(3)->create()
]);

test('should throws exception when cities already belong to another group', function ($data) {
    Group::factory()->has(City::factory(2))->create();
    CreateGroup::run($data);
})->with([
    ['data' => ['name' => 'Grupo teste','cities_id' => [1,2,3]], 'Grupo teste'],
])->throws(Exception::class);
