<?php

namespace App\Http\Controllers;

use App\Actions\City\CreateCity;
use App\Actions\City\DeleteCity;
use App\Actions\City\ListCity;
use App\Actions\City\UpdateCity;
use App\Http\Requests\StoreCityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CityController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return CityResource::collection(ListCity::run(\request()->get('per_page')));
    }

    public function store(StoreCityRequest $request): CityResource
    {
        return CityResource::make(CreateCity::run($request->validated()));
    }

    public function show(City $city): CityResource
    {
        return CityResource::make($city);
    }

    public function update(StoreCityRequest $request, City $city): CityResource
    {
        return CityResource::make(UpdateCity::run($request->validated(), $city));
    }

    public function destroy(City $city): CityResource
    {
        return CityResource::make(DeleteCity::run($city));
    }
}
