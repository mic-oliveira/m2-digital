<?php

use App\Actions\Campaign\UpdateCampaign;
use App\Models\Campaign;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should update campaign', function ($data, Campaign $campaign) {
    $result = UpdateCampaign::run($data, $campaign);
    expect($result->name)->toBe($data['name']);
})->with([
    ['data' => ['name' => 'Nome atualizado']],
    ['data' => ['name' => 'Nome atualizado 2']],
])->with([fn() => Campaign::factory()->create()]);

test('should update groups attached to campaigns', function ($data, Campaign $campaign) {
    $result = UpdateCampaign::run($data, $campaign);
    expect($result->groups()->count())->toBe(1);
})->with([
    ['data' => ['groups_id' => [1]]],
    ['data' => ['groups_id' => [2]]],
])->with([fn() => Campaign::factory()->has(Group::factory(3), 'groups')->create()]);

test('should not update groups if alredy belong to another campaign', function ($data, Campaign $campaign) {
    UpdateCampaign::run($data, $campaign);
})->with([
    ['data' => ['groups_id' => [2]]],
    ['data' => ['groups_id' => [1,3]]],
])->with([
    fn() => Campaign::factory()->has(Group::factory(1), 'groups')->create()
])->with([
    fn() => Campaign::factory()->has(Group::factory(3), 'groups')->create()
])->throws(Exception::class);
