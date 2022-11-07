<?php

use App\Actions\Group\DeleteGroup;
use App\Models\Group;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should delete a group', function (Group $group) {
    $result = DeleteGroup::run($group);
    expect($result->name)->toBe($group->name)
        ->and($result->deleted_at)->not()->toBeNull();
})->with([
    fn() => Group::factory()->create()
]);

test('should throws exception when delete group twice', function (Group $group) {
    DeleteGroup::run($group);
    DeleteGroup::run($group);
})->with([
    fn() => Group::factory()->create()
])->throws(ModelNotFoundException::class);
