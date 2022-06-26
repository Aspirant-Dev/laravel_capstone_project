<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalkInOrder_Details extends Model
{
    protected $table = 'walk_in_order__details';

    protected $fillable = ['order_id','product_id','unitprice','quantity','amount',];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id')->withTrashed();
    }
}
