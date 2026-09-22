<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'service_category_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'starting_price',
        'whatsapp_message_template',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starting_price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function packages(): HasMany
    {
        return $this->hasMany(ServicePackage::class);
    }
}