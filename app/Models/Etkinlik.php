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
        'city',
        'district',
        'title',
        'slug',
        'content',
        'image',
        'location',
        'category',
        'cost',
        'date',
        'source_type',
        'status',
        'is_active',
        'views',
        'capacity',
        'rsvp_enabled',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'date'      => 'datetime',
        'is_active' => 'boolean',
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

    public function getDescriptionAttribute()
    {
        return $this->content;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['content'] = $value;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
