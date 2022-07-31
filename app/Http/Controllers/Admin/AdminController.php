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
use App\Sales;
use Carbon\Carbon;
use DB;
use Session;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
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

    public function ajaxTable()
    {
        $model = Order::all();

        return Datatables::of($model)->editColumn('created_at', function ($order)
        {
            return date('F-d-Y (g:i a)', strtotime($order->created_at) );
        })->editColumn('address', function ($order) {
            return $order->address.', '. $order->barangay.', '. $order->city.', '. $order->postal_code;
        })->editColumn('total_price', function ($order){
            return "₱ ". number_format($order->total_price,2);
        })->editColumn('status', function ($order) {
            if ($order->status == 0)
            {
                $status = 'Pending';
                $badge = 'badge-info';
            }
            elseif($order->status == 1)
            {
                $status = 'Processing';
                $badge = 'badge-info';
            }
            elseif($order->status == 2)
            {
                $status = 'For Delivery';
                $badge = 'badge-warning';
            }
            elseif($order->status == 3)
            {
                $status = 'Delivered';
                $badge = 'badge-success';
            }
            elseif($order->status == 4)
            {
                $status = 'Cancelled';
                $badge = 'badge-danger';
            }
            return compact('status','badge');
        })->make(true);
    }
    public function ajaxTablePending()
    {
        $model = Order::where('status',0)->get();

        return Datatables::of($model)->editColumn('created_at', function ($order)
        {
            return date('F-d-Y (g:i a)', strtotime($order->created_at) );
        })->editColumn('address', function ($order) {
            return $order->address.', '. $order->barangay.', '. $order->city.', '. $order->postal_code;
        })->editColumn('total_price', function ($order){
            return "₱ ". number_format($order->total_price,2);
        })->editColumn('status', function ($order) {
            if ($order->status == 0)
            {
                $status = 'Pending';
                $badge = 'badge-info';
            }
            elseif($order->status == 1)
            {
                $status = 'Processing';
                $badge = 'badge-info';
            }
            elseif($order->status == 2)
            {
                $status = 'For Delivery';
                $badge = 'badge-warning';
            }
            elseif($order->status == 3)
            {
                $status = 'Delivered';
                $badge = 'badge-success';
            }
            elseif($order->status == 4)
            {
                $status = 'Cancelled';
                $badge = 'badge-danger';
            }
            return compact('status','badge');
        })->make(true);
    }
    public function ajaxTableProcessing()
    {
        $model = Order::where('status',1)->get();

        return Datatables::of($model)->editColumn('created_at', function ($order)
        {
            return date('F-d-Y (g:i a)', strtotime($order->created_at) );
        })->editColumn('address', function ($order) {
            return $order->address.', '. $order->barangay.', '. $order->city.', '. $order->postal_code;
        })->editColumn('total_price', function ($order){
            return "₱ ". number_format($order->total_price,2);
        })->editColumn('status', function ($order) {
            if ($order->status == 0)
            {
                $status = 'Pending';
                $badge = 'badge-info';
            }
            elseif($order->status == 1)
            {
                $status = 'Processing';
                $badge = 'badge-info';
            }
            elseif($order->status == 2)
            {
                $status = 'For Delivery';
                $badge = 'badge-warning';
            }
            elseif($order->status == 3)
            {
                $status = 'Delivered';
                $badge = 'badge-success';
            }
            elseif($order->status == 4)
            {
                $status = 'Cancelled';
                $badge = 'badge-danger';
            }
            return compact('status','badge');
        })->make(true);
    }
    public function ajaxTableDelivery()
    {
        $model = Order::where('status',2)->get();

        return Datatables::of($model)->editColumn('created_at', function ($order)
        {
            return date('F-d-Y (g:i a)', strtotime($order->created_at) );
        })->editColumn('address', function ($order) {
            return $order->address.', '. $order->barangay.', '. $order->city.', '. $order->postal_code;
        })->editColumn('total_price', function ($order){
            return "₱ ". number_format($order->total_price,2);
        })->editColumn('status', function ($order) {
            if ($order->status == 0)
            {
                $status = 'Pending';
                $badge = 'badge-info';
            }
            elseif($order->status == 1)
            {
                $status = 'Processing';
                $badge = 'badge-info';
            }
            elseif($order->status == 2)
            {
                $status = 'For Delivery';
                $badge = 'badge-warning';
            }
            elseif($order->status == 3)
            {
                $status = 'Delivered';
                $badge = 'badge-success';
            }
            elseif($order->status == 4)
            {
                $status = 'Cancelled';
                $badge = 'badge-danger';
            }
            return compact('status','badge');
        })->make(true);
    }
    public function ajaxTableDelivered()
    {
        $model = Order::where('status',3)->get();

        return Datatables::of($model)->editColumn('created_at', function ($order)
        {
            return date('F-d-Y (g:i a)', strtotime($order->created_at) );
        })->editColumn('address', function ($order) {
            return $order->address.', '. $order->barangay.', '. $order->city.', '. $order->postal_code;
        })->editColumn('total_price', function ($order){
            return "₱ ". number_format($order->total_price,2);
        })->editColumn('status', function ($order) {
            if ($order->status == 0)
            {
                $status = 'Pending';
                $badge = 'badge-info';
            }
            elseif($order->status == 1)
            {
                $status = 'Processing';
                $badge = 'badge-info';
            }
            elseif($order->status == 2)
            {
                $status = 'For Delivery';
                $badge = 'badge-warning';
            }
            elseif($order->status == 3)
            {
                $status = 'Delivered';
                $badge = 'badge-success';
            }
            elseif($order->status == 4)
            {
                $status = 'Cancelled';
                $badge = 'badge-danger';
            }
            return compact('status','badge');
        })->make(true);
    }
    public function ajaxTableCancelled()
    {
        $model = Order::where('status',4)->get();

        return Datatables::of($model)->editColumn('created_at', function ($order)
        {
            return date('F-d-Y (g:i a)', strtotime($order->created_at) );
        })->editColumn('address', function ($order) {
            return $order->address.', '. $order->barangay.', '. $order->city.', '. $order->postal_code;
        })->editColumn('total_price', function ($order){
            return "₱ ". number_format($order->total_price,2);
        })->editColumn('status', function ($order) {
            if ($order->status == 0)
            {
                $status = 'Pending';
                $badge = 'badge-info';
            }
            elseif($order->status == 1)
            {
                $status = 'Processing';
                $badge = 'badge-info';
            }
            elseif($order->status == 2)
            {
                $status = 'For Delivery';
                $badge = 'badge-warning';
            }
            elseif($order->status == 3)
            {
                $status = 'Delivered';
                $badge = 'badge-success';
            }
            elseif($order->status == 4)
            {
                $status = 'Cancelled';
                $badge = 'badge-danger';
            }
            return compact('status','badge');
        })->make(true);
    }

    public function getCount()
    {
        $ordercount = Order::where('payment_method','=','COD')->where('status',0)->count();
        echo $ordercount;
    }
    public function getCountOnlinePayment()
    {
        $orderOPcount = Order::where('payment_method','!=','COD')->where('status',1)->count();
        echo $orderOPcount;
    }
    public function ajax()
    {
        $model = Order::where('payment_method','=','COD')->where('status',0)->get();

        return Datatables::of($model)->editColumn('created_at', function ($order)
        {
            return date('M-d-Y (g:i a)', strtotime($order->created_at) );
        })->make(true);
    }
    public function ajaxOP()
    {
        $model = Order::where('payment_method','!=','COD')->where('status',1)->get();

        return Datatables::of($model)->editColumn('created_at', function ($order)
        {
            return date('M-d-Y (g:i a)', strtotime($order->created_at) );
        })->make(true);
    }
    public function countUsers()
    {
        $count_users = User::all()->count();
        echo $count_users;
    }
    public function countCrits()
    {
        $countCrits = Product::whereRaw('critical_level >= stocks')->count();
        echo $countCrits;
    }
    public function getCompleted()
    {
        $completed = Order::where('status','3')->count();
        echo $completed;
    }
    public function countReturns()
    {
        $countReturns = ReturnedProducts::where('status',0)->count();
        if ($countReturns > 0) {
            echo $countReturns;
        }
    }
    public function countOnOrders()
    {
        $countCod = Order::where('status',0)->where('payment_method','=','COD')->count();
        $countOnline = Order::where('status',1)->where('payment_method','!=','COD')->count();

        $counter = 0;
        if($countOnline > 0)
        {
            $counter += $countOnline;
        }
        if($countCod > 0)
        {
            $counter += $countCod;
        }

        if($counter > 0)
        {
            echo $counter;
        }
    }
    public function getOnSales()
    {
        $onlineSales = DB::table("orders")->where('status','3')->get()->sum("total_price");
        echo number_format($onlineSales,2);
    }
    public function getWalkSales()
    {
        $walkin_sales = DB::table("walk_in_order__details")->get()->sum("amount");
        echo number_format($walkin_sales,2);
    }
    public function getWalk()
    {
        $walk =  WalkInOrder::all()->count();
        echo $walk;
    }
    public function admin_index()
    {

        $count = User::all();
        $prods = Product::all();
        $prods_active = Product::where('status',1)->get();
        $prods_inactive = Product::where('status',0)->get();
        $walkin = WalkInOrder::all();
        $walkin_sales = DB::table("walk_in_order__details")->get()->sum("amount");
        $orders_sales = DB::table("orders")->where('status','3')->get()->sum("total_price");
        $orders = Order::where('status','0')->get();
        $completed = Order::where('status','3')->get();
        $crit_stocks = Product::whereRaw('critical_level >= stocks')->get();
        $latest = Order::where('status','2')->get();
        // $request_cancel = Order::where('status','6')->get();
        $getUsersCity = User::select('city',DB::raw('count(city) as count'))->groupBy('city')->get()->toArray();

        return view('admin.pages.dashboard',
                compact('count','prods','prods_active','prods_inactive', 'orders','crit_stocks',
                        'completed','orders_sales','walkin',
                        'walkin_sales','getUsersCity','latest'));
    }
    public function customer_index()
    {
        $users = User::all();
        return view('admin.pages.customers')->with('users',$users);
    }
    public function report_orders()
    {
        return view('admin.pages.reports.orders');
    }
    public function delivery()
    {
        $delivered = Order::where('status','3')->get();
        $delivery_users = Admin::where('user_type','Delivery')->get();
        return view('admin.pages.delivery.delivery-record',compact('delivered','delivery_users'));
    }
    public function edit_delivery(Request $request, $id)
    {
        $order = Order::find($id);
        $order->updated_by = $request->input('delivered_by').' (Updated by Admin)';
        $order->update();
        return redirect()->back()->with('success','Delivery Record Updated Successfully');
    }
    public function delivery_details($id)
    {
        if(Order::where('id',$id)->exists())
        {
            $order = Order::where('id',$id)->first();
            $item_id = OrderItem::find($id);
            $returnedItem = ReturnedProducts::where('item_id',$item_id->id)->first();

            return view('admin.pages.delivery.delivery-details',compact('order','returnedItem'));
        }
        else
        {
            return redirect()->back();
        }
    }
    public function ajaxDeliveryRecordTable()
    {
        $model = Order::where('status',3)->get();

        return Datatables::of($model)->editColumn('date_delivered', function ($order)
        {
            return date('F-d-Y', strtotime($order->completed_at) );
        })->editColumn('customer_name', function ($order) {
            return $order->fname.' '. $order->lname;
        })->editColumn('address', function ($order) {
            return $order->address.', '. $order->barangay.', '. $order->city.', '. $order->postal_code;
        })->editColumn('total_price', function ($order){
            return "₱ ". number_format($order->total_price,2);
        })->editColumn('status', function ($order) {
            if ($order->status == 0)
            {
                $status = 'Pending';
                $badge = 'badge-info';
            }
            elseif($order->status == 1)
            {
                $status = 'Processing';
                $badge = 'badge-info';
            }
            elseif($order->status == 2)
            {
                $status = 'For Delivery';
                $badge = 'badge-warning';
            }
            elseif($order->status == 3)
            {
                $status = 'Delivered';
                $badge = 'badge-success';
            }
            elseif($order->status == 4)
            {
                $status = 'Cancelled';
                $badge = 'badge-danger';
            }
            return compact('status','badge');
        })->make(true);
    }
    public function view_return_products()
    {
        $return_items = ReturnedProducts::all();
        $orders = Order::orderBy('id','DESC')->get();
        return view('admin.pages.return-products.index',compact('return_items','orders'));
    }
    public function ajaxReturnTable()
    {
        $model = ReturnedProducts::all();

        return Datatables::of($model)->editColumn('tracking_no', function ($order)
        {
            return $order->orders->tracking_no;
        })->editColumn('customer_name', function ($order)
        {
            return ucfirst($order->orders->fname).' '.ucfirst($order->orders->lname);
        })->editColumn('product_name', function ($order){
            return $order->products->name;

        })->editColumn('status', function ($order) {
            if ($order->status == 0)
            {
                $status = '<span class="badge badge-secondary" style="font-size: 14px; border-radius: 0px; padding: 12px;">Request for return product</span>';
            }
            elseif ($order->status == 1)
            {
                $status = '<span class="badge badge-info" style="font-size: 14px; border-radius: 0px; padding: 12px;">Approved Request <br> (Waiting for customer)</span>';
            }
            elseif ($order->status == 2)
            {
                $status = '<span class="badge badge-success" style="font-size: 14px; border-radius: 0px; padding: 12px;">Returned</span>';
            }
            else
            {
                $status = '<span class="badge badge-danger" style="font-size: 14px; border-radius: 0px; padding: 12px;">Not Approved</span>';
            }
            return $status;
        })->editColumn('date_returned', function ($order) {
            if ($order->status == 2)
            {
                $data = date('F d, Y', strtotime($order->date_returned));
            }
            elseif ($order->status == 3)
            {
                $data = 'Not Approved. <br>{{ '.$order->message.'}}';
            }
            else
            {
                $data = 'Processing';
            }
            return $data;

        })->make(true);
    }
    public function update(Request $request, $id)
    {
        $prod_return = ReturnedProducts::find($id);

        $orderItem_id = $request->input('item_id');
        $item_id = OrderItem::find($orderItem_id);

        $prod_return->status = $request->input('order_status');

        if($prod_return->status == '1')
        {
            $item_id->status = 2; // for approved return item
            $item_id->update();

            $email = $prod_return->orders->email;

            $messageData = [
                'email' => $email,
                'name' =>ucfirst($prod_return->orders->fname).' '.ucfirst($prod_return->orders->lname),
                'productDetails' => $prod_return,
                'product_name' => $prod_return->products->name,
                'product_qty' => $prod_return->quantity,
            ];

            Mail::send('emails.approved',$messageData, function ($message) use($email){
                $message->to($email)->subject('Your request was approved');
            });
        }

        elseif($prod_return->status == '2')
        {
            $qty = $request->input('qty');
            $prod = Product::where('id',$item_id->products->id)->first();
            $before = $prod->stocks;

            $item_id->status = 3; // for returned status

            $prod->stocks = $prod->stocks - $qty;

            $item_id->update();
            $prod->update();

            $prod_return->date_returned = Carbon::now()->format('Y-m-d');
        }
        elseif($prod_return->status == '3')
        {
            $message = $request->input('message');

            $prod_return->message = $message;

            $item_id->status = 4; // for not approved return item
            $item_id->update();

            $email = $prod_return->orders->email;

            $messageData = [
                'email' => $email,
                'name' =>ucfirst($prod_return->orders->fname).' '.ucfirst($prod_return->orders->lname),
                'productDetails' => $prod_return,
                'product_name' => $prod_return->products->name,
                'product_qty' => $prod_return->quantity,
                'reason' => $prod_return->reason,
                'message' => $prod_return->message,
            ];

            Mail::send('emails.not-approve',$messageData, function ($message) use($email){
                $message->to($email)->subject('Your request was not approved');
            });
        }
        $prod_return->update();

        return redirect()->back()->with('success','Status updated successfully');

    }

    public function report_inventory()
    {
        $prods = Product::all();
        return view('admin.pages.reports.inventory',compact('prods'));
    }
    public function pdfInventory()
    {
        $prods = Product::all();

        return view('admin.pages.reports.pdf.inventory',compact('prods'));
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $model = Order::where('id', $id);
        $model->delete();

        return response()->json(['status' => 'deleted!','icon'=>'success']);
    }
}
