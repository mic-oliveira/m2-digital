<?php

use App\Actions\Product\DeleteProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should delete a group', function (Product $group) {
    $result = DeleteProduct::run($group);
    expect($result->name)->toBe($group->name)
        ->and($result->deleted_at)->not()->toBeNull();
})->with([
    fn() => Product::factory()->create()
]);

test('should throws exception when delete group twice', function (Product $group) {
    DeleteProduct::run($group);
    DeleteProduct::run($group);
})->with([
    fn() => Product::factory()->create()
])->throws(ModelNotFoundException::class);
