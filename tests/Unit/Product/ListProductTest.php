<?php

use App\Actions\Product\ListProduct;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should list product equal paginated size', function ($list_size, $page_size, $expected) {
    Product::factory()->count($page_size)->create();
    $result = ListProduct::run($list_size);
    expect($result->count())->toBe($expected);
})->with([
    [10,10,10],
    [20,15,15],
])->with();
