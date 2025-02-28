<?php

namespace App\Models\Pages;

use App\Models\Traits\ServiceScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes, ServiceScopes;

    protected $fillable = [
        'name',
        'description',
    ];
}
