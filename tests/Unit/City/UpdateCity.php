<?php

use App\Actions\City\UpdateCity;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should update city', function ($data, City $city) {
    $result = UpdateCity::run($data, $city);
    expect($result->name)->toBe($data['name']);
})->with([
    ['data' => ['name' => 'Nome atualizado']],
    ['data' => ['name' => 'Nome atualizado 2']],
])->with([fn() => City::factory()->create()]);
