<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    protected $table = 'banners';
    protected $fillable = ['title','subtitle','image','image_w480','status'];

    protected $dates = ['deleted_at'];
}
