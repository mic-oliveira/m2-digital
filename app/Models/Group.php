<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'price'
    ];

    public function cities(): BelongsToMany
    {
        return $this
            ->belongsToMany(City::class, 'cities_groups', 'group_id', 'city_id');
    }

    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class, 'groups_campaigns', 'group_id', 'campaign_id');
    }
}
