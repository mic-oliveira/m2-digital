<?php

namespace App\Models;

use App\Enums\CampaignStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'campaigns';

    protected $fillable = [
        'name',
        'status',
        'description'
    ];

    protected $casts = [
        'status' => CampaignStatusEnum::class
    ];


    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'groups_campaigns', 'campaign_id', 'group_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_campaigns', 'campaign_id', 'product_id');
    }
}
