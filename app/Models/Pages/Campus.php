<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;
use App\Models\Traits\CampusScopes;
use App\Traits\LogsMediaActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Campus extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations, CampusScopes, LogsActivity, LogsMediaActivity;

    protected $table = 'campuses';

    public $translatable = ['title', 'content'];

    protected $fillable = [
        'user_id',
        'branch_id',
        'title',
        'content',
        'views',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'images',
        'branch_name',
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
        if (!$this->branch) {
            return null;
        }
        return [
            'id' => $this->branch->id,
            'name' => $this->branch->getTranslations('name'), // Get all translations as JSON
            'slug' => $this->branch->slug,
        ];
    }

    /**
     * Get the options for activity logging.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'content', 'branch_id', 'is_active', 'order', 'views'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Campus {$eventName}");
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']);

        $this->addMediaCollection('attachments')
            ->acceptsMimeTypes([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ]);
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(Media $media = null): void
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

        $this->addMediaConversion('og_image')
            ->width(1200)
            ->height(630)
            ->sharpen(10)
            ->nonQueued();
    }

    /**
     * Get the user that created this campus.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the branch for this campus.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Scope a query to only include active campus.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by branch.
     */
    public function scopeOfBranch($query, $branchId)
    {
        if ($branchId) {
            return $query->where('branch_id', $branchId);
        }
        return $query;
    }

    /**
     * Scope a query to get published campus.
     */
    public function scopePublished($query)
    {
        return $query->where('created_at', '<=', Carbon::now());
    }

    /**
     * Scope a query to get latest campus.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Increment the views count.
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Get formatted published date.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M d, Y');
    }
}
