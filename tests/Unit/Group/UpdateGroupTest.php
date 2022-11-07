<?php

use App\Actions\Group\UpdateGroup;
use App\Models\Campaign;
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


test('should create a group and attach campaign to group', function ($data, $expected, Group $group) {
    $result = UpdateGroup::run($data, $group);
    expect($result->name)->toBe($expected)
        ->and($result->campaigns()->pluck('id')->all())->toContain($data['campaign_id']);
})->with([
    ['data' => ['name' => 'Grupo teste','campaign_id' => 2], 'Grupo teste'],
])->with([
    fn() => Group::factory()->has(Campaign::factory(), 'campaigns')->create()
])->with([
    fn() => Campaign::factory(3)->create()
]);
