<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\File;

use App\Mail\PlaceorderMailable;
use App\Product;
use App\Order;
use App\Carts;
use App\OrderItem;
use App\Category;
use App\User;
use App\Address;
use App\GCash_Payment;
use Session;
use App\OrdersLog;

use App\Events\NewOrders;
use App\Events\Updates;

use App\Events\SendNotifyAlert;
class PaypalController extends Controller
{
    public function index()
    {
        if(Session::has('total'))
        {

            $categories = Category::where('status','1')->get();

            $deliveryAdresses = Session::get('deliveryAdresses');
            // dd($deliveryAdresses);
            return view('frontend.paypal.paypal',compact('deliveryAdresses','categories'));
        }
        else
        {
            return redirect('cart');
        }
    }
    public function placeOrderMailable($name, $total, $tracking_no,$address)
    {
        $order_data = [
            'name' => $name,
            'address' => $address,
            'total' => $total,
            'tracking_no' => $tracking_no,
            'payment_method' => 'PayPal',
        ];

        $items_in_cart = Carts::where('user_id', Auth::user()->id)->get();
        $cart_items = json_decode($items_in_cart, true);

        $to_customer_email = Auth::user()->email;
        Mail::to($to_customer_email)->send(new PlaceorderMailable($order_data, $items_in_cart));
    }

    public function store(Request $request)
    {
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $barangay = $request->input('barangay');
        $city = $request->input('city');
        $postal_code = $request->input('postal_code');
        $country = $request->input('country');

        // Insert Order Details
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->fname = $fname;
        $order->lname = $lname;
        $order->email = Auth::user()->email;
        $order->address = $address;
        $order->barangay = $barangay;
        $order->city = $city;
        $order->postal_code = $postal_code;
        $order->phone_no = $phone;

        // To compute the total price
        $total = 0;
        $cartItems_total = Carts::where('user_id', Auth::user()->id)->get();
        foreach($cartItems_total as $prod)
        {
            $total += $prod->products->price * $prod->product_qty;
        }

        $order->total_price = $total;
        $order->tracking_no = rand(1111,9999);
        $order->status = 1;

        $order->payment_method = "PayPal";
        $order->payment_gateway = "PayPal";
        $order->save();

        // pass the items to order items table
        $cartItems = Carts::where('user_id', Auth::user()->id)->get();
        foreach($cartItems as $item)
        {
        $orderItem = OrderItem::create([
                'order_id'=>$order->id,
                'product_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->products->price,
            ]);
        }

        $items_order = OrderItem::where('order_id', $order->id)->get();
        foreach($items_order as $item)
        {
            $prod = Product::where('id', $item->product_id)->first();
            $prod->stocks = $prod->stocks - $item->qty;
            $prod->update();
        }

        $log = new OrdersLog();

        $log->order_id = $order->id;
        $log->order_status = 'In Process';
        $log->save();

        $tracking_no = $order->tracking_no;
        $name = $order->fname.' '. $order->lname;
        $address = $order->address.', '.$order->barangay.', '. $order->city.', '. $order->postal_code;

        // send mail
        $this->placeOrderMailable($name, $total, $tracking_no, $address);

        // delete items from cart
        Carts::where('user_id',Auth::user()->id)->delete();

        $countCod = Order::where('status',0)->where('payment_method','=','COD')->count();
        $countOnline = Order::where('status',1)->where('payment_method','!=','COD')->count();

        // real time notification
        $text = 0;
        if($countOnline > 0)
        {
            $text += $countOnline;
        }
        if($countCod > 0)
        {
            $text += $countCod;
        }

        event(new NewOrders($text));

        $text =  '('.Order::all()->count().')';
        $text1 = Order::where('status',0)->get()->count() > 0 ? '('.Order::where('status',0)->get()->count().')' : '';
        $text2 = Order::where('status',1)->get()->count() > 0 ? '('.Order::where('status',1)->get()->count().')' : '';
        $text3 = Order::where('status',2)->get()->count() > 0 ? '('.Order::where('status',2)->get()->count().')' : '';
        $text4 = Order::where('status',3)->get()->count() > 0 ? '('.Order::where('status',3)->get()->count().')' : '';
        $text5 = Order::where('status',4)->get()->count() > 0 ? '('.Order::where('status',4)->get()->count().')' : '';

        event(new Updates($text,$text1,$text2,$text3,$text4,$text5));

        $alert = 'New order has been placed. Payment Method: Paypal';
        event(new SendNotifyAlert($alert));
        return response()->json(['status'=> 'Your order placed successfully!']);
    }
}
