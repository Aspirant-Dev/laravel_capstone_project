<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GCash_Payment extends Model
{
    //
    protected $table = 'gcash_payment';

    protected $fillable = [
        'order_id',
        'user_id',
        'amount_due',
        'image',
    ];
}
