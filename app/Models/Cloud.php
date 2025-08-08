<?php

namespace App\Models;

use App\Enums\CloudType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Cloud extends Model
{
    use HasUuids;

    protected $fillable = [
        'display_name',
        'type',
        'data',
    ];

    protected $casts = [
        'type' => CloudType::class,
        'data' => 'array',
    ];

    /**
     * Get cloud data as an array.
     *
     */
    public function getDataAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }
}
