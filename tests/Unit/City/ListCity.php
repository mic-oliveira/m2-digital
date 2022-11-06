<?php

use App\Actions\City\ListCity;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should list city equal paginated size', function ($list_size, $page_size, $expected) {
    City::factory()->count($page_size)->create();
    $result = ListCity::run($list_size);
    expect($result->count())->toBe($expected);
})->with([
    [10,10,10],
    [20,15,15],
])->with();
