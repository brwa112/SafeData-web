<?php

namespace App\Models\Pages;

use App\Models\Traits\ProductScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, ProductScopes;

    protected $fillable = [
        'name',
        'description',
        'url',
    ];
}
