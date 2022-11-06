<?php

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should return a list of groups', function () {
    $response = $this->get('/api/groups');
    $response->assertOk();
});

it('should create a group', function () {
    $response = $this->postJson('/api/groups', ['name' => 'teste']);
    $response->assertCreated();
});

it('should find a group', function () {
    $response = $this->getJson('/api/groups/1');
    $response->assertOk();
    $response = $this->getJson('/api/groups/2');
    $response->assertOk();
})->with([
    fn() => Group::factory(2)->create()
]);

it('should return 404 when id not exists on groups', function () {
    $response = $this->getJson('/api/groups/1');
    $response->assertNotFound();
});

it('should update a group', function () {
    $response = $this->putJson('/api/groups/1', ['name' => 'Grupo atualizado']);
    $response->assertOk();
})->with([
    fn() => Group::factory(2)->create()
]);

it('should return unprocessed entity when name already exists on database', function () {
    $response = $this->putJson('/api/groups/1', ['name' =>  'Grupo atualizado']);
    $response->assertUnprocessable();
})->with([
    fn() => Group::factory()->state(['name' => 'Grupo atualizado'])->create()
]);

it('should delete a group', function () {
    $response = $this->deleteJson('/api/groups/1');
    $response->assertOk();
})->with([
    fn() => Group::factory()->create()
]);

it('should return 404 on delete group not existent', function () {
    $response = $this->deleteJson('/api/groups/1');
    $response->assertNotFound();
});
