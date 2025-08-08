<?php

namespace App\Models;

use App\Enums\CloudType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cloud extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'type',
        'display_name',
        'data',
    ];

    protected $casts = [
        'type' => CloudType::class,
        'data' => 'array',
    ];

    /**
     * Get the user that owns the cloud.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get cloud data as an array.
     *
     */
    public function getDataAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }
}
