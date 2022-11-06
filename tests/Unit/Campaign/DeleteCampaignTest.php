<?php

use App\Actions\Campaign\DeleteCampaign;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should delete a campaign', function (Campaign $campaign) {
    $result = DeleteCampaign::run($campaign);
    expect($result->name)->toBe($campaign->name)
        ->and($result->deleted_at)->not()->toBeNull();
})->with([
    fn() => Campaign::factory()->create()
]);

test('should throws exception when delete campaign twice', function (Campaign $campaign) {
    DeleteCampaign::run($campaign);
    DeleteCampaign::run($campaign);
})->with([
    fn() => Campaign::factory()->create()
])->throws(ModelNotFoundException::class);
