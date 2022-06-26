<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Admin;
use App\Product;
use App\OrderItem;
use App\Order;
use App\WalkInOrder;
use App\ReturnedProducts;
use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Support\Facades\Mail;

class CountOrdersController extends Controller
{
    public function ordersCount()
    {
        if(Auth::check())
        {
            $ordercount = Order::where('status',0)->count();

            return response()->json(['count'=> $ordercount]);
        }
    }
}
