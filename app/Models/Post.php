<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{
    use HasFactory,HasApiTokens;

    public function getRouteKeyName()
    {
       return 'slug';
    }

    protected $guarded = [];
}
