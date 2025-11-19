<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'location_id',
        'property_category_id',
        'title',
        'slug',
        'description',
        'youtube_url',
        'price',
        'property_type',
        'bedrooms',
        'bathrooms',
        'land_size',
        'land_size_unit',
        'address',
        'latitude',
        'longitude',
        'availability',
        'is_featured',
        'is_published',
        'published_at',
        'rejection_notes',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'land_size' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title) . '-' . Str::random(6);
            }
        });

        static::updating(function ($property) {
            if ($property->isDirty('title') && empty($property->slug)) {
                $property->slug = Str::slug($property->title) . '-' . Str::random(6);
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function category()
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order');
    }

    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'property_amenity')
            ->withTimestamps();
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('availability', 'available');
    }

    public function scopeForSale($query)
    {
        return $query->where('property_type', 'sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('property_type', 'rent');
    }

    // Helper methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function approve()
    {
        $this->update([
            'is_published' => true,
            'published_at' => now(),
            'rejection_notes' => null,
        ]);
    }

    public function reject(string $notes)
    {
        $this->update([
            'is_published' => false,
            'rejection_notes' => $notes,
        ]);
    }

    public function getFormattedPriceAttribute()
    {
        return '₦' . number_format($this->price, 2);
    }

    public function getPrimaryImageUrlAttribute()
    {
        if ($this->primaryImage) {
            return $this->primaryImage->url;
        }
        
        if ($this->images->count() > 0) {
            return $this->images->first()->url;
        }
        
        return asset('images/placeholder-property.jpg');
    }

    public function getYoutubeEmbedUrlAttribute()
    {
        if (!$this->youtube_url) {
            return null;
        }

        $url = $this->youtube_url;
        
        // Extract video ID from various YouTube URL formats
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
            $videoId = $matches[1];
        } else {
            return null;
        }

        return "https://www.youtube.com/embed/{$videoId}";
    }
}
