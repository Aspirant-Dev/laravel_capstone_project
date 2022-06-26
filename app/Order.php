<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderItem;
use App\GCash_Payment;
use App\ReturnedProducts;

class Order extends Model
{
    //

    protected $table = 'orders';

    protected $fillable = [
        'user_id','fname','lname', 'email','address','barangay','city','postal_code','phone_no',
        'total_price','status','tracking_no','payment_method','payment_method','updated_by'
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function orderGcash()
    {
        return $this->hasMany(GCash_Payment::class);
    }
    public function returnItems()
    {
        return $this->hasMany(ReturnedProducts::class);
    }
}
