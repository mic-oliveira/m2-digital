<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cities';

    protected $fillable = [
      'name',
    ];

    public function groups(): BelongsToMany
    {
        return $this
            ->belongsToMany(Group::class, 'cities_groups', 'city_id', 'group_id');
    }
}
