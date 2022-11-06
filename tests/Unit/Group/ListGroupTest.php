<?php

use App\Actions\Group\ListGroup;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should list group equal paginated size', function ($list_size, $page_size, $expected) {
    Group::factory()->count($page_size)->create();
    $result = ListGroup::run($list_size);
    expect($result->count())->toBe($expected);
})->with([
    [10,10,10],
    [20,15,15],
])->with();
