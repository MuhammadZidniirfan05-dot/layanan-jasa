<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePackage extends Model
{
    protected $fillable = [
        'service_id',
        'name',
        'price',
        'delivery_days',
        'features',
        'is_popular',
        'order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}