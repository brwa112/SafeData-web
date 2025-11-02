<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Gallery extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations, LogsActivity;

    protected $table = 'galleries';

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'user_id',
        'branch_id',
        'gallery_category_id',
        'title',
        'description',
        'views',
        'order',
        'is_active',
        'slug',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'images',
        'branch_name',
        'category_name',
    ];

    public function getImagesAttribute()
    {
        return $this->getMedia('images')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
                'thumb' => $media->getUrl('thumb'),
                'medium' => $media->getUrl('medium'),
            ];
        });
    }

    public function getBranchNameAttribute()
    {
        if (! $this->branch) {
            return null;
        }
        return [
            'id' => $this->branch->id,
            'name' => $this->branch->getTranslations('name'),
            'slug' => $this->branch->slug,
        ];
    }

    public function getCategoryNameAttribute()
    {
        if (! $this->category) {
            return null;
        }
        return [
            'id' => $this->category->id,
            'name' => $this->category->getTranslations('name'),
            'slug' => $this->category->slug,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'description', 'branch_id', 'gallery_category_id', 'is_active', 'order', 'views'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Gallery item {$eventName}");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']);
    }

    public function registerMediaConversions(SpatieMedia $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(900)
            ->sharpen(10)
            ->nonQueued();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Scopes to support filters in controller
    public function scopeSearch($query, $term)
    {
        if (! $term) return $query;
        return $query->whereJsonContains('title', $term)
                     ->orWhere('id', $term);
    }

    public function scopeFilterByDateRange($query, $start, $end)
    {
        if ($start && $end) {
            return $query->whereBetween('created_at', [$start, $end]);
        }
        if ($start) return $query->where('created_at', '>=', $start);
        if ($end) return $query->where('created_at', '<=', $end);
        return $query;
    }

    public function scopeFilterByBranch($query, $branchId)
    {
        if ($branchId) return $query->where('branch_id', $branchId);
        return $query;
    }

    public function scopeFilterByCategory($query, $categoryId)
    {
        if ($categoryId) return $query->where('gallery_category_id', $categoryId);
        return $query;
    }
}
