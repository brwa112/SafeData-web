<?php

namespace App\Models\Pages;

use App\Models\System\Users\User;
use Spatie\Activitylog\LogOptions;
use App\Models\Traits\ProductScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity,ProductScopes;

    protected $fillable = [
        'name',
        'description',
        'url',
        'user_id',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'url'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Product {$eventName}");
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
