<?php

namespace App\Http\Controllers\Admin\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Product;
use App\WalkInOrder;
use App\WalkInOrder_Details;
use App\Transaction;
use App\Sales;
use App\Order;
use App\Events\AdminDashboard;
use App\Events\SendNotifyAlert;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    public function getCount()
    {
        $products = Product::all()->count();
        echo $products;
    }
    public function view_products()
    {
        $products = Product::all();
        return view('cashier.view-products',compact('products'));
    }
    public function view_critical_stocks()
    {
        $products = Product::whereRaw('stocks <= critical_level')->get();
        return view('cashier.view-critical-stocks',compact('products'));
    }
    public function pos()
    {

        $new = WalkInOrder::max('id')+1;
        // dd($new);
        $products = Product::where('status',1)->where('stocks','>',0)->get();
        return view('cashier.pos',compact('products','new'));
    }
    public function placeOrder(Request $request)
    {
            $orders = new WalkInOrder;
            $orders->invoice_no = rand(11111,99999);
            $orders->name = ucwords($request->name);
            $orders->phone = $request->phone_no;
            $orders->user_id = Auth::user()->id;
            $orders->balance = $request->balance;
            $orders->paid_amount = $request->paid_amount;
            $orders->transact_date = date('Y-m-d');

            $total = 0;
            for ($product_id = 0; $product_id < count($request->product_id); $product_id++)
            {
                $total += $request->total_amount[$product_id];
            }

            $orders->transact_amount = $total;
            $orders->save();
            $order_id = $orders->id;

            $total = 0;
            // insert Walk in Order Details
            for ($product_id = 0; $product_id < count($request->product_id); $product_id++)
            {
                $order_details = new WalkInOrder_Details;
                $order_details->order_id = $order_id;
                $order_details->product_id = $request->product_id[$product_id];
                $order_details->unitprice = $request->price[$product_id];
                $order_details->quantity = $request->quantity[$product_id];
                $order_details->amount = $request->total_amount[$product_id];
                $order_details->save();

                $total += $request->total_amount[$product_id];
            }

            $items_order = WalkInOrder_Details::where('order_id', $order_id)->get();
            foreach($items_order as $item)
            {
               $prod = Product::where('id', $item->product_id)->first();
               $prod->stocks = $prod->stocks - $item->quantity;
               $prod->update();
            }

            $sales = new Sales();
            $sales->trans_Date = $orders->transact_date;
            $sales->cus_name = $request->name;
            $sales->invoice = $orders->invoice_no;
            $sales->transact_Amount = $orders->transact_amount;
            $sales->payment_method = 'Cash';
            $sales->save();

            $data = Order::where('status',3)->count();
            $onlineSales = DB::table("orders")->where('status','3')->get()->sum("total_price");
            $data1 = number_format($onlineSales,2);
            $walkin_sales = DB::table("walk_in_order__details")->get()->sum("amount");
            $data2 = number_format($walkin_sales,2);
            $data3 =  WalkInOrder::all()->count();

            event(new AdminDashboard($data,$data1,$data2,$data3));

            $alert = 'New order for walk-in transaction';
            event(new SendNotifyAlert($alert));

        return redirect('admin/cashier/walkin-view-order/'.$order_id);
    }
    public function walkIn()
    {
        $orders = WalkInOrder::all();
        return view('cashier.walk-in',compact('orders'));
    }
    public function view($id)
    {
        $orders = WalkInOrder::where('id',$id)->first();
        $orderItems = WalkInOrder_Details::where('order_id',$id)->get();
        return view('cashier.view-order',compact('orders','orderItems'));
    }
    public function pdfInvoice($id)
    {
        $orders = WalkInOrder::where('id',$id)->first();
        $orderItems = WalkInOrder_Details::where('order_id',$id)->get();

        return view('cashier.invoice_pdf',compact('orders','orderItems'));
    }
}
