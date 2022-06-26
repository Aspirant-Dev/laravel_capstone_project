<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\WalkInOrder_Details;

class WalkInOrder extends Model
{
    protected $table = 'walkin';
    protected $fillable = ['invoice_no','name','phone','paid_amount','balance','transact_date','transact_amount','user_id'];

    public function orderItems()
    {
        return $this->hasMany(WalkInOrder_Details::class);
    }
}
