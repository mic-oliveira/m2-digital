<?php

use App\Actions\Group\UpdateGroup;
use App\Models\City;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should update group', function ($data, Group $group) {
    $result = UpdateGroup::run($data, $group);
    expect($result->name)->toBe($data['name']);
})->with([
    ['data' => ['name' => 'Nome atualizado']],
    ['data' => ['name' => 'Nome atualizado 2']],
])->with([fn() => Group::factory()->create()]);

test('should update cities attached to group', function ($data, Group $group) {
    $result = UpdateGroup::run($data, $group);
    expect($result->cities()->count())->toBe(1);
})->with([
    ['data' => ['cities_id' => [1]]]
])->with([fn() => Group::factory()->has(City::factory(5), 'cities')->create()]);
