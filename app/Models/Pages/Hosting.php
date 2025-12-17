<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;
use Spatie\Activitylog\LogOptions;
use App\Models\Traits\HostingScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Hosting extends Model
{
    use HasFactory, SoftDeletes,LogsActivity, HostingScopes;

    protected $fillable = [
        'name',
        'description',
        'popular',
        'user_id',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'popular'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Hosting {$eventName}");
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
