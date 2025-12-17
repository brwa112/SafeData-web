<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;

use Spatie\Activitylog\LogOptions;
use App\Models\Traits\ServiceScopes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes, LogsActivity,ServiceScopes;

    protected $fillable = [
        'name',
        'description',
        'icon',
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
}
