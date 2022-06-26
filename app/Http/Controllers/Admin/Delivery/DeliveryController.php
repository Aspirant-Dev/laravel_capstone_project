<?php

namespace App\Http\Controllers\Admin\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Order;
use App\GCash_Payment;
use App\Sales;
use App\OrdersLog;
use App\WalkInOrder;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Mail;

use App\Events\FormSubmitted;
use App\Events\AdminDashboard;
use App\Events\UserSubmitted;
use App\Events\Updates;
use App\Events\SendDelivered;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
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
    public function ajaxDelivery()
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
    public function getCountAll()
    {
        $getAll = Order::all()->count();
        echo $getAll;
    }
    public function getCountPending()
    {
        $getAll = Order::where('status',0)->count();
        echo $getAll;
    }
    public function getCountProcessing()
    {
        $getAll = Order::where('status',1)->count();
        echo $getAll;
    }
    public function getCountDelivery()
    {
        $getAll = Order::where('status',2)->count();
        echo $getAll;
    }
    public function getCountCompleted()
    {
        $getAll = Order::where('status',3)->count();
        echo $getAll;
    }
    public function getCountCancelled()
    {
        $getAll = Order::where('status',4)->count();
        echo $getAll;
    }
    public function getDelivery()
    {
        $counter = Order::where('status',2)->count();
        if ($counter > 0) {
            echo $counter;
        }
    }
    public function index()
    {
        $latest = Order::where('status','2')->get();
        $orders = Order::where('status','2')->orderBy('id','DESC')->get();
        return view('delivery.manage-order',compact('orders','latest'));
    }
    public function view($id)
    {
        $latest = Order::where('status','2')->get();
        $orders = Order::where('id',$id)->first();
        $orderLog = OrdersLog::where('order_id',$id)->get();
        $gcash = GCash_Payment::where('order_id',$id)->first();
        return view('delivery.view-update-order',compact('orders','latest','gcash','orderLog'));
    }
    public function invoice($id)
    {
        if(Order::where('id',$id)->exists())
        {
            $orders = Order::where('id',$id)->first();

            return view('admin.pages.orders.invoice',compact('orders'));
        }
        else
        {
            return redirect('admin/view-orders');
        }
    }
    public function pdfInvoice($id)
    {
        $orders = Order::where('id',$id)->first();

        return view('admin.pages.orders.pdf-invoice',compact('orders'));
    }
    public function updateOrder(Request $request, $id)
    {
        $orders = Order::find($id);

        $orders->status = $request->input('order_status');
        $orders->updated_by = Auth::user()->full_name;

        if($orders->status == '2')
        {
            // $message = "Your order ".$orders->tracking_no.' has been updated to processing status';
            $orderDetails = Order::with('orderItems')->where('id',$id)->first()->toArray();

            $email = $orders->email;
            $messageData = [
                'email' =>$email,
                'name' =>ucfirst($orders->fname).' '.ucfirst($orders->lname),
                'tracking_no' => $orders->tracking_no,
                'orderDetails' => $orders->orderItems,
                'orders' => $orders
            ];

            Mail::send('emails.fordeliveryorder',$messageData, function ($message) use($email){
                $message->to($email)->subject('Your order is ready for delivery');
            });
        }
        elseif ($orders->status == '3') {

            $orderDetails = Order::with('orderItems')->where('id',$id)->first()->toArray();

            $email = $orders->email;
            $messageData = [
                'email' =>$email,
                'name' =>ucfirst($orders->fname).' '.ucfirst($orders->lname),
                'tracking_no' => $orders->tracking_no,
                'orderDetails' => $orders->orderItems,
                'orders' => $orders
            ];

            Mail::send('emails.deliveredorder',$messageData, function ($message) use($email){
                $message->to($email)->subject('Your order has been delivered');
            });

            $orders->completed_at = Carbon::now()->format('Y-m-d');

            // uploading image proof
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'order-'. $orders->id .'-proof'.'.'.$ext;

            $file->move('uploads/proofs/',$filename);
            $orders->image = $filename;

            $sales = new Sales();
            $sales->trans_Date = date('Y-m-d', strtotime($orders->created_at));
            $sales->cus_name = ucfirst($orders->fname).' '.ucfirst($orders->lname);
            $sales->invoice = $orders->tracking_no;
            $sales->transact_Amount = $orders->total_price;
            $sales->payment_method = $orders->payment_method;
            $sales->save();
        }
        $orders->update();

        $text =  Order::where('user_id',$orders->user_id)->get()->count();
        $text1 = Order::where('user_id',$orders->user_id)->where('status',0)->get()->count();
        $text2 = Order::where('user_id',$orders->user_id)->where('status',1)->get()->count();
        $text3 = Order::where('user_id',$orders->user_id)->where('status',2)->get()->count();
        $text4 = Order::where('user_id',$orders->user_id)->where('status',3)->get()->count();
        $text5 = Order::where('user_id',$orders->user_id)->where('status',4)->get()->count();

        event(new FormSubmitted($text,$text1,$text2,$text3,$text4,$text5));

        $data = Order::where('status',3)->count();
        $onlineSales = DB::table("orders")->where('status','3')->get()->sum("total_price");
        $data1 = number_format($onlineSales,2);
        $walkin_sales = DB::table("walk_in_order__details")->get()->sum("amount");
        $data2 = number_format($walkin_sales,2);
        $data3 =  WalkInOrder::all()->count();

        event(new AdminDashboard($data,$data1,$data2,$data3));

        $log = new OrdersLog();

        if ($orders->status == 0) {
            $order_status = 'Pending';
        }
        elseif ($orders->status == 1) {
            $order_status = 'In Process';
        }
        elseif ($orders->status == 2) {
            $order_status = 'For Delivery';
        }
        elseif ($orders->status == 3) {
            $order_status = 'Delivered';
        }
        elseif ($orders->status == 4) {
            $order_status = 'Cancelled';
        }
        else{
            $order_status = 'Cancelled';
        }
        $log->order_id = $orders->id;
        $log->order_status = $order_status;
        $log->updated_by = Auth::user()->full_name.' ('.Auth::user()->user_type.')';
        $log->save();

        $text =  Order::all()->count();
        $text1 = Order::where('status',0)->get()->count() > 0 ? '('.Order::where('status',0)->get()->count().')' : '';
        $text2 = Order::where('status',1)->get()->count() > 0 ? '('.Order::where('status',1)->get()->count().')' : '';
        $text3 = Order::where('status',2)->get()->count() > 0 ? '('.Order::where('status',2)->get()->count().')' : '';
        $text4 = Order::where('status',3)->get()->count() > 0 ? '('.Order::where('status',3)->get()->count().')' : '';
        $text5 = Order::where('status',4)->get()->count() > 0 ? '('.Order::where('status',4)->get()->count().')' : '';

        event(new Updates($text,$text1,$text2,$text3,$text4,$text5));
        if($orders->status == 1)
        {
            $items_order = OrderItem::where('order_id', $orders->id)->get();
            foreach($items_order as $item)
            {
               $prod = Product::where('id', $item->product_id)->first();
               $prod->stocks = $prod->stocks - $item->qty;
               $prod->update();
            }
            // return Product::all('name','stocks');
            return redirect()->route('admin.delivery.view-order')->with('success','Order Updated Successfully');
        }
        else
        {
            $msgAlert = 'Order '.$orders->tracking_no.' has been delivered successfully.';
            event(new SendDelivered($msgAlert));
            return redirect()->route('admin.delivery.view-order')->with('success','Order Updated Successfully');
        }
    }
    public function view_order()
    {
        $latest = Order::where('status','2')->get();
        $orders = Order::orderBy('id','DESC')->get();
        return view('delivery.view-orders',compact('orders','latest'));
    }
    public function view_order_pending()
    {
        $latest = Order::where('status','2')->get();
        $orders = Order::where('status','0')->orderBy('id','DESC')->get();
        return view('delivery.view-orders',compact('orders','latest'));
    }
    public function view_order_processing()
    {
        $latest = Order::where('status','2')->get();
        $orders = Order::where('status','1')->orderBy('id','DESC')->get();
        return view('delivery.view-orders',compact('orders','latest'));
    }
    public function view_order_for_delivery()
    {
        $latest = Order::where('status','2')->get();
        $orders = Order::where('status','2')->orderBy('id','DESC')->get();
        return view('delivery.view-orders',compact('orders','latest'));
    }
    public function view_order_delivered()
    {
        $latest = Order::where('status','2')->get();
        $orders = Order::where('status','3')->orderBy('id','DESC')->get();
        return view('delivery.view-orders',compact('orders','latest'));
    }
    public function view_order_cancelled_returned()
    {
        $latest = Order::where('status','2')->get();
        $orders = Order::where('status','>','3')->orderBy('id','DESC')->get();
        return view('delivery.view-orders',compact('orders','latest'));
    }
}
