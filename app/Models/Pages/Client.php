<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use App\Models\Traits\ClientScopes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, LogsActivity, ClientScopes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'user_id',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Client {$eventName}");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['logo']; // Ensure logo is included in JSON

    public function getLogoAttribute()
    {
        return $this->getFirstMediaUrl('logo');
    }
}
