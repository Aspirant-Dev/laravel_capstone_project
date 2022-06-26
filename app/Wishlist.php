<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{

    use SoftDeletes;
    protected $table ="wishlist";

    protected $fillable = [
        'user_id','product_id',
    ];
    protected $dates = ['deleted_at'];
    public function products()
    {
        // return $this->belongsTo(Product::class,'product_id','id');
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
