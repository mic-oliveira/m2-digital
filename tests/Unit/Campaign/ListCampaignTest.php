<?php

use App\Actions\Campaign\ListCampaign;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should list campaign equal paginated size', function ($list_size, $page_size, $expected) {
    Campaign::factory()->count($page_size)->create();
    $result = ListCampaign::run($list_size);
    expect($result->count())->toBe($expected);
})->with([
    [10,10,10],
    [20,15,15],

])->with();
