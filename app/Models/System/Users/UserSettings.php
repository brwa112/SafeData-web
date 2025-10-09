<?php

namespace App\Models\System\Users;

use App\Models\System\Settings\Settings\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserSettings extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'font_scale',
        'font_weight',
        'theme',
        'language_id',
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
