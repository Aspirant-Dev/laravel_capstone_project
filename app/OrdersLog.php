<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersLog extends Model
{

    protected $table = 'orders_logs';

    protected $fillable = [
        'order_id','order_status','updated_by'
    ];
}
