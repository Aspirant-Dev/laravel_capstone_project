<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $table = 'order_items';

    protected $fillable = [
        'order_id','product_id', 'qty','price'
    ];
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id')->withTrashed();
    }
}
