<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class NewsCategory extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    public $translatable = [
        'name',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all news articles in this category
     */
    public function news()
    {
        return $this->hasMany(News::class, 'news_category_id');
    }

    /**
     * Increment usage count when category is used
     */
    public function incrementUsage()
    {
        // Optional: You can add a usage_count field if needed
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "News Category {$eventName}");
    }
}
