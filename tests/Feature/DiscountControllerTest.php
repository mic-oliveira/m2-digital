<?php

use App\Models\Discount;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should return a list of cities', function () {
    $response = $this->get('/api/discounts');
    $response->assertOk();
});

it('should create a discount', function () {
    $response = $this->postJson('/api/discounts', ['name' => 'teste', 'percentage' => 50]);
    $response->assertCreated();
});

it('should find a discount', function () {
    $response = $this->getJson('/api/discounts/1');
    $response->assertOk();
    $response = $this->getJson('/api/discounts/2');
    $response->assertOk();
})->with([
    fn() => Discount::factory(2)->create()
]);

it('should return 404 when id not exists on discounts', function () {
    $response = $this->getJson('/api/discounts/1');
    $response->assertNotFound();
});

it('should update a discount', function () {
    $response = $this->putJson('/api/discounts/1', ['name' => 'Desconto atualizada']);
    $response->assertOk();
})->with([
    fn() => Discount::factory(2)->create()
]);

it('should return unprocessed entity when name already exists on database', function () {
    $response = $this->putJson('/api/discounts/1', ['name' => 'Desconto atualizada']);
    $response->assertUnprocessable();
})->with([
    fn() => Discount::factory()->state(['name' => 'Desconto atualizada'])->create()
]);

it('should delete a discount', function () {
    $response = $this->deleteJson('/api/discounts/1');
    $response->assertOk();
})->with([
    fn() => Discount::factory()->create()
]);

it('should return 404 on delete discount not existent', function () {
    $response = $this->deleteJson('/api/discount/1');
    $response->assertNotFound();
});
