<?php

use App\Actions\Campaign\CreateCampaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('should create campaign', function ($campaignData, $expected) {
    $result = CreateCampaign::run($campaignData);
    expect($result->name)->toBe($expected);

})->with([
    ['data' => ['name' => 'Teste'],'Teste'],
    ['data' => ['name' => 'Teste 2'], 'Teste 2'],
]);


test('should not create campaign with same name', function ($campaignData) {
    CreateCampaign::run($campaignData);
    CreateCampaign::run($campaignData);

})->with([
    ['data' => ['name' => 'Teste']],
    ['data' => ['name' => 'Teste 2']],
])->throws(Exception::class);

test('should not create campaign without a name', function () {
    CreateCampaign::run(['name' => '']);
    CreateCampaign::run(['name' => null]);
})->throws(Exception::class);

test('should not create campaign null param', function () {
    CreateCampaign::run(null);
})->throws(TypeError::class);
