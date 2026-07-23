<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Etkinlik extends Model
{
    protected $table = 'etkinlikler';

    protected $fillable = [
        'user_id',
        'city_id',
        'district_id',
        'title',
        'slug',
        'description',
        'image',
        'location',
        'category',
        'cost',
        'date',
        'source_type',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($etkinlik) {
            if (empty($etkinlik->slug)) {
                $etkinlik->slug = Str::slug($etkinlik->title) . '-' . Str::random(6);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
