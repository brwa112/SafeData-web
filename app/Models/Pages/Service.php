<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;

use Spatie\Activitylog\LogOptions;
use App\Models\Traits\ServiceScopes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, LogsActivity, ServiceScopes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'description', 'color', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Branch {$eventName}");
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['logo'];

    public function getLogoAttribute()
    {
        return $this->getFirstMediaUrl('logo');
    }
}
