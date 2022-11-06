<?php

use App\Actions\City\DeleteCity;
use App\Actions\Discount\DeleteDiscount;
use App\Actions\Group\DeleteGroup;
use App\Actions\Product\DeleteProduct;
use App\Models\City;
use App\Models\Discount;
use App\Models\Group;
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
