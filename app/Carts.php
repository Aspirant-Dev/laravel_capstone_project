<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carts extends Model
{
    //
    use SoftDeletes;
    protected $table ="carts";

    protected $fillable = [
        'user_id','product_id', 'product_qty',
    ];

    protected $dates = ['deleted_at'];
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
