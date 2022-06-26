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
use App\Admin;
use App\Sales;
use Response;

use App\Mail\CancelorderMailable;
// reference the Dompdf namespace
use Dompdf\Dompdf;

use App\Events\FormSubmitted;
use App\Events\Updates;
use App\Events\NewOrders;

class OrderController extends Controller
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
                $orders = Order::orderBy('id','DESC')->get();
                return view('admin.pages.orders',compact('orders'));
            }
            else{
                return back()->with('info','Unauthorized Account');
            }
        }
    }
    public function view($id)
    {

        if(Order::where('id',$id)->exists())
        {
            $orders = Order::where('id',$id)->first();
            $gcash = GCash_Payment::where('order_id',$id)->first();
            $orderLog = OrdersLog::where('order_id',$id)->get();
            return view('admin.pages.orders.view',compact('orders','gcash','orderLog'));
        }
        else
        {
            return redirect('admin/view-orders');
        }
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
        if($orders->status == '1')
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

            Mail::send('emails.order_status',$messageData, function ($message) use($email){
                $message->to($email)->subject('Order Being Processed');
            });

        }
        elseif($orders->status == '2')
        {
            $delivery = Admin::where('user_type','Delivery')->get();
            foreach($delivery as $delivery)
            {
                $email_del = $delivery->email;
                $mData = [
                    // 'email' =>$email,
                    'name' =>ucfirst($delivery->full_name),
                    'orders' => $orders
                ];

                Mail::send('emails.notif-delivery',$mData, function ($messageDelivery) use($email_del){
                    $messageDelivery->to($email_del)->subject('Order is ready for delivery');
                });
            }

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

        // if($orders->status == 2)
        // {
        // }
        // real time notification
        $text = Order::where('status',2)->count();
        event(new NewOrders($text));

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
            return redirect()->back()->with('alert','Order Updated Successfully');
        }
        else
        {
            return redirect()->back()->with('alert','Order Updated Successfully');
        }
    }
    public function downloadImg($id)
    {
        $order = Order::find($id);
        // local host
        // $file= public_path()."/uploads/proofs/".$order->image;
        // production
        $file = '/home/u903542296/domains/realvalueenterprise.online/public_html/uploads/proofs/'.$order->image;
        return Response::download($file);
    }
    public function cancel_order($id)
    {
        $orders = Order::find($id);
        $orders->status = '4';
        $orders->reason = 'Incorrect GCash Receipt Image.';
        $orders->update();
        $items_order = OrderItem::where('order_id', $orders->id)->get();
            foreach($items_order as $item)
            {
               $prod = Product::where('id', $item->product_id)->first();
               $prod->stocks = $prod->stocks + $item->qty;
               $prod->update();
            }

            $log = new OrdersLog();
            $log->order_id = $orders->id;
            $log->order_status = 'Cancelled';
            $log->updated_by = Auth::user()->full_name.' ('.Auth::user()->user_type.')';
            $log->save();

        $orderDetails = Order::with('orderItems')->where('id',$id)->first()->toArray();

            $email = $orders->email;
            $messageData = [
                'email' =>$email,
                'name' =>ucfirst($orders->fname).' '.ucfirst($orders->lname),
                'tracking_no' => $orders->tracking_no,
                'orderDetails' => $orders->orderItems,
                'orders' => $orders
            ];

            Mail::send('emails.forcancellorder',$messageData, function ($message) use($email){
                $message->to($email)->subject('Your order has been cancelled');
            });

            $text =  Order::where('user_id',$orders->user_id)->get()->count();
            $text1 = Order::where('user_id',$orders->user_id)->where('status',0)->get()->count();
            $text2 = Order::where('user_id',$orders->user_id)->where('status',1)->get()->count();
            $text3 = Order::where('user_id',$orders->user_id)->where('status',2)->get()->count();
            $text4 = Order::where('user_id',$orders->user_id)->where('status',3)->get()->count();
            $text5 = Order::where('user_id',$orders->user_id)->where('status',4)->get()->count();

            event(new FormSubmitted($text,$text1,$text2,$text3,$text4,$text5));
            return redirect()->back()->with('alert','Order Updated Successfully');
    }
    // filter
    public function view_order_pending()
    {
        $orders = Order::where('status','0')->orderBy('id','DESC')->get();
    return view('admin.pages.orders',compact('orders'));
        }
    public function view_order_processing()
    {
        $orders = Order::where('status','1')->orderBy('id','DESC')->get();
        return view('admin.pages.orders',compact('orders'));
    }
    public function view_order_for_delivery()
    {
        $orders = Order::where('status','2')->orderBy('id','DESC')->get();
        return view('admin.pages.orders',compact('orders'));
    }
    public function view_order_delivered()
    {
        $orders = Order::where('status','3')->orderBy('id','DESC')->get();
        return view('admin.pages.orders',compact('orders'));
    }
    public function view_order_cancelled_returned()
    {
        $orders = Order::where('status','4')->orderBy('id','DESC')->get();
        return view('admin.pages.orders',compact('orders'));
    }

}
