<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductUnit extends Model
{
    //
    use SoftDeletes;

    protected $table = 'units';

    protected $fillable = ['unit_name','description'];

    protected $dates = ['deleted_at'];
}
