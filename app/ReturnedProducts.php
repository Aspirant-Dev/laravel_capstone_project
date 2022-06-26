<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnedProducts extends Model
{
    //
    protected $table = 'return_orders';

    protected $fillable = ['order_id','user_id','product_id','reason','quantity','product_image','image_receipt','detailed_reason','date_returned'];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function orders()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
