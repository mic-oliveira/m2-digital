<?php

use App\Actions\City\DeleteCity;
use App\Actions\Discount\DeleteDiscount;
use App\Models\City;
use App\Models\Discount;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should delete a discount', function (Discount $discount) {
    $result = DeleteDiscount::run($discount);
    expect($result->name)->toBe($discount->name)
        ->and($result->deleted_at)->not()->toBeNull();
})->with([
    fn() => Discount::factory()->create()
]);

test('should throws exception when delete discount twice', function (Discount $discount) {
    DeleteDiscount::run($discount);
    DeleteDiscount::run($discount);
})->with([
    fn() => Discount::factory()->create()
])->throws(ModelNotFoundException::class);
