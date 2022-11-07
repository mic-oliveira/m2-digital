<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'price'
    ];

    public function citiesBelongToAnotherGroup(array $cities_id): bool
    {
        if (DB::table('cities_groups')->whereIn('city_id', $cities_id)->exists()) {
            throw new UnprocessableEntityHttpException('um elemento de cities_id já pertence a um group');
        }
        return true;
    }

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
