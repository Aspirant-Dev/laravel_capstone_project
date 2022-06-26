<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Address extends Model
{
    protected $table ="users_address";
    protected $fillable = [
        'user_id',
        'email',
        'fname',
        'lname',
        'phone_no',
        'city',
        'barangay',
        'postal_code',
        'detailed_address',
    ];

    public static function deliveryAdresses()
    {
        $user_id = Auth::user()->id;
        $deliveryAdresses = Address::where('user_id',$user_id)->get()->toArray();
        return $deliveryAdresses;
    }
}
