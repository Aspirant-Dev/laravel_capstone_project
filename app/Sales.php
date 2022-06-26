<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $fillable = ['trans_Date','cus_name','invoice','transact_Amount','payment_method'];
}
