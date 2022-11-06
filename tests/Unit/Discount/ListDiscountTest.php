<?php

use App\Actions\Discount\ListDiscount;
use App\Models\Discount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should list discount equal paginated size', function ($list_size, $page_size, $expected) {
    Discount::factory()->count($page_size)->create();
    $result = ListDiscount::run($list_size);
    expect($result->count())->toBe($expected);
})->with([
    [10,10,10],
    [20,15,15],
])->with();
