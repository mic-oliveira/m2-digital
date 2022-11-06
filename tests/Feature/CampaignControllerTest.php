<?php

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should return a list of campaigns', function () {
    $response = $this->getJson('/api/campaigns');
    $response->assertOk();
});

it('should create a campaigns', function () {
    $response = $this->postJson('/api/campaigns', ['name' => 'teste']);
    $response->assertCreated();
});

it('should find a campaign', function () {
    $response = $this->getJson('/api/campaigns/1');
    $response->assertOk();
    $response = $this->getJson('/api/campaigns/2');
    $response->assertOk();
})->with([
    fn() => Campaign::factory(2)->create()
]);

it('should return 404 when id not exists on campaigns', function () {
    $response = $this->getJson('/api/campaigns/1');
    $response->assertNotFound();
});

it('should update a campaign', function () {
    $response = $this->putJson('/api/campaigns/1', ['name' => 'Campanha atualizada']);
    $response->assertOk();
})->with([
    fn() => Campaign::factory(2)->create()
]);

it('should return unprocessed entity when name already exists on database', function () {
    $response = $this->putJson('/api/campaigns/1', ['name' => 'Campanha atualizada']);
    $response->assertUnprocessable();
})->with([
    fn() => Campaign::factory()->state(['name' => 'Campanha atualizada'])->create()
]);

it('should delete a campaign', function () {
    $response = $this->deleteJson('/api/campaigns/1');
    $response->assertOk();
})->with([
    fn() => Campaign::factory()->create()
]);

it('should return 404 on delete campaign not existent', function () {
    $response = $this->deleteJson('/api/campaigns/1');
    $response->assertNotFound();
});





