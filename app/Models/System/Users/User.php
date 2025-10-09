<?php

namespace App\Models\System\Users;

use App\Models\Pages\Client;
use App\Models\Pages\Hosting;
use App\Models\Pages\Product;
use App\Models\Pages\Service;
use App\Models\System\Settings\Reasons\Log;
use App\Models\System\Settings\Settings\FontSize;
use App\Models\System\Settings\Settings\Theme;
use App\Models\System\Settings\System\LayerOneGroupNamePermissions;
use App\Models\System\Settings\System\LayerOnePermission;
use App\Models\System\Settings\System\UserType;
use App\Models\System\Users\UserSettings;
use App\Models\Traits\UserScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
    use InteractsWithMedia, UserScopes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_active',
        'user_type_id',
        'reseller_id',
        'client_id',
        'font_size_id',
        'theme',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['avatar']; // Ensure avatar is included in JSON

    public function getAvatarAttribute()
    {
        return $this->getFirstMediaUrl('avatar');
    }

    public function settings()
    {
        return $this->hasOne(UserSettings::class);
    }

    public function LayerOneGroupName()
    {
        return $this->hasMany(LayerOneGroupNamePermissions::class);
    }

    public function LayerOnePermission()
    {
        return $this->hasMany(LayerOnePermission::class);
    }

    public function fontsize()
    {
        return $this->hasMany(FontSize::class, 'user_id', 'id');
    }

    public function font()
    {
        return $this->belongsTo(FontSize::class, 'font_size_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function theme()
    {
        return $this->hasMany(Theme::class);
    }

    public function typeuser()
    {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }
}
