<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should return a list of products', function () {
    $response = $this->get('/api/products');
    $response->assertOk();
});

it('should create a product', function () {
    $response = $this->postJson('/api/products', ['name' => 'teste', 'price' => 99.99]);
    $response->assertCreated();
});

it('should find a product', function () {
    $response = $this->getJson('/api/products/1');
    $response->assertOk();
    $response = $this->getJson('/api/products/2');
    $response->assertOk();
})->with([
    fn() => Product::factory(2)->create()
]);

it('should return 404 when id not exists on products', function () {
    $response = $this->getJson('/api/products/1');
    $response->assertNotFound();
});

it('should update a product', function () {
    $response = $this->putJson('/api/products/1', ['name' => 'Grupo atualizado']);
    $response->assertOk();
})->with([
    fn() => Product::factory()->create()
]);

it('should return unprocessed entity when name already exists on database', function () {
    $response = $this->putJson('/api/products/1', ['name' =>  'Grupo atualizado']);
    $response->assertUnprocessable();
})->with([
    fn() => Product::factory()->state(['name' => 'Grupo atualizado'])->create()
]);

it('should delete a product', function () {
    $response = $this->deleteJson('/api/products/1');
    $response->assertOk();
})->with([
    fn() => Product::factory()->create()
]);

it('should return 404 on delete product not existent', function () {
    $response = $this->deleteJson('/api/products/1');
    $response->assertNotFound();
});
