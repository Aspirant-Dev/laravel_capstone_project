<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use Auth;
use App\Order;
use App\OrderItem;
use App\Product;
use App\GCash_Payment;
use App\OrdersLog;
use Carbon\Carbon;
use App\WalkInOrder_Details;
use App\WalkInOrder;

use Yajra\DataTables\DataTables;
use App\Mail\CancelorderMailable;

class WalkinOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    public function index()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {
                $orders = WalkInOrder::orderBy('id','DESC')->get();
                return view('admin.pages.walkin-orders.index',compact('orders'));

            }
            else{
                return back()->with('info','Unauthorized Account');
            }
        }
    }
    public function view($id)
    {
        $orders = WalkInOrder::find($id);
        $orderItems = WalkInOrder_Details::where('order_id',$id)->get();
        return view('admin.pages.walkin-orders.view',compact('orders','orderItems'));
    }
    public function ajaxTable()
    {
        $model = WalkInOrder::all();

        return Datatables::of($model)->editColumn('transact_date', function ($order)
        {
            return date('F-d-Y (g:i a)', strtotime($order->created_at) );
        })->editColumn('transact_amount', function ($order)
        {
            return "₱ ". number_format($order->transact_amount,2);
        })->editColumn('paid_amount', function ($order){
            return "₱ ". number_format($order->paid_amount,2);
        })->editColumn('balance', function ($order) {
            if ($order->balance > 0)
            {
                $balance = "₱ ".number_format($order->balance,2);
                $badge = 'bg-gradient-success';
            }
            elseif ($order->balance < 0)
            {
                $balance = $order->balance;
                $badge = 'bg-gradient-danger';
            }
            return compact('balance','badge');
        })->make(true);
    }
}
