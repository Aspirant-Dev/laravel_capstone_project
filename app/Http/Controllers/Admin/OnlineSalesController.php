<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Admin;
use App\Product;
use App\OrderItem;
use App\Order;
use App\WalkInOrder;
use Carbon\Carbon;
use DB;
use Session;

class OnlineSalesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function report_sales()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {
                $now = Carbon::now()->format('Y-m-d');

                $query = Order::where('status','3')->where('completed_at','like', '%'.$now.'%')->get();
                return view('admin.pages.reports.sales',compact('query'));
            }
            else
            {
                return back();
            }
        }

    }
    public function report_sales_yesterday()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {
                $yesterday = Carbon::now()->subDays(1)->format('Y-m-d');

                $query = Order::where('status','3')->where('completed_at','like', '%'.$yesterday.'%')->get();
                return view('admin.pages.reports.sales',compact('query'));
            }
            else
            {
                return back();
            }
        }
    }
    public function report_sales_last_7_days()
    {
        $from = Carbon::now()->subDays(7)->format('Y-m-d');
        $to = Carbon::now()->subDays(1)->format('Y-m-d');

        $range = Carbon::now()->subDays(7)->format('M/d/Y').' - '. Carbon::now()->subDays(1)->format('M/d/Y');


        $query = Order::where('status','3')
                        ->where('completed_at','>=',$from)
                        ->where('completed_at','<=',$to)
                        ->get();

        return view('admin.pages.reports.sales',compact('query','range'));
    }
    public function report_sales_this_month()
    {
        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $range = Carbon::now()->subDays(30)->format('M/d/Y').' - '. Carbon::now()->format('M/d/Y');

        $query = Order::where('status','3')
                        ->where('completed_at','>=',$from)
                        ->where('completed_at','<=',$to)
                        ->get();

        return view('admin.pages.reports.sales',compact('query','range'));
    }

    public function search(Request $request)
    {

        $fromDate = $request->input('fromDate');
        $toDate =  $request->input('toDate');
        $query = DB::table('orders')->select()
                    ->where('status','3')
                    ->where('completed_at','>=',$fromDate)
                    ->where('completed_at','<=',$toDate)
                    ->get();

        if($fromDate == $toDate)
        {
            $data = date('M/d/Y', strtotime($fromDate));
        }
        else
        {
            $data = date('M/d/Y', strtotime($fromDate)).' - '.date('M/d/Y', strtotime($toDate));
        }

        Session::put('searched',$data);

        return view('admin.pages.reports.sales',compact('query'));
    }
}