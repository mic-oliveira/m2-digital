<?php

namespace App\Http\Controllers;

use App\Actions\Campaign\CreateCampaign;
use App\Actions\Campaign\ListCampaign;
use App\Actions\Campaign\UpdateCampaign;
use App\Actions\Product\CreateProduct;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CampaignController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return CampaignResource::collection(ListCampaign::run(\request()->get('per_page')));
    }

    public function store(StoreCampaignRequest $request): CampaignResource
    {
        return CampaignResource::make(CreateCampaign::run($request->validated()));
    }

    public function show(Campaign $campaign): CampaignResource
    {
        return CampaignResource::make($campaign);
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign): CampaignResource
    {
        return CampaignResource::make(UpdateCampaign::run($request->validated(), $campaign));
    }

    public function destroy(Campaign $campaign): CampaignResource
    {
        return CampaignResource::make($campaign);
    }
}
