<?php

use App\Actions\City\DeleteCity;
use App\Models\City;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should delete a city', function (City $city) {
    $result = DeleteCity::run($city);
    expect($result->name)->toBe($city->name)
        ->and($result->deleted_at)->not()->toBeNull();
})->with([
    fn() => City::factory()->create()
]);

test('should throws exception when delete city twice', function (City $city) {
    DeleteCity::run($city);
    DeleteCity::run($city);
})->with([
    fn() => City::factory()->create()
])->throws(ModelNotFoundException::class);
