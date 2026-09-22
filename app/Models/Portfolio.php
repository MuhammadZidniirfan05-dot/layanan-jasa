<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'description',
        'thumbnail',
        'images',
        'client_name',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}