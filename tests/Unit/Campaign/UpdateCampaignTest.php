<?php

use App\Actions\Campaign\UpdateCampaign;
use App\Models\Campaign;
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

