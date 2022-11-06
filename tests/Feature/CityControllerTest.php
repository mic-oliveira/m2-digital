<?php

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should return a list of cities', function () {
    $response = $this->get('/api/cities');
    $response->assertOk();
});

it('should create a city', function () {
    $response = $this->postJson('/api/cities', ['name' => 'teste']);
    $response->assertCreated();
});

it('should find a city', function () {
    $response = $this->getJson('/api/cities/1');
    $response->assertOk();
    $response = $this->getJson('/api/cities/2');
    $response->assertOk();
})->with([
    fn() => City::factory(2)->create()
]);

it('should return 404 when id not exists on cities', function () {
    $response = $this->getJson('/api/cities/1');
    $response->assertNotFound();
});

it('should update a city', function () {
    $response = $this->putJson('/api/cities/1', ['name' => 'Cidade atualizada']);
    $response->assertOk();
})->with([
    fn() => City::factory(2)->create()
]);

it('should return unprocessed entity when name already exists on database', function () {
    $response = $this->putJson('/api/cities/1', ['name' => 'Cidade atualizada']);
    $response->assertUnprocessable();
})->with([
    fn() => City::factory()->state(['name' => 'Cidade atualizada'])->create()
]);

it('should delete a city', function () {
    $response = $this->deleteJson('/api/cities/1');
    $response->assertOk();
})->with([
    fn() => City::factory()->create()
]);

it('should return 404 on delete city not existent', function () {
    $response = $this->deleteJson('/api/cities/1');
    $response->assertNotFound();
});
