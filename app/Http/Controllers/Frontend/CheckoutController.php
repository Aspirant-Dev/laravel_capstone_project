<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use App\Mail\PlaceorderMailable;
use App\Product;
use App\Order;
use App\Carts;
use App\OrderItem;
use App\Category;
use App\User;
use App\Address;
use Session;
use App\OrdersLog;

use App\Events\NewOrders;
use App\Events\Updates;
use App\Events\SendNotifyAlert;
use Luigel\Paymongo\Facades\Paymongo;
class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function checkout()
    {
        if(Auth::check())
        {
            if(!Auth::user()->hasVerifiedEmail())
            {
                $categories = Category::where('status','1')->get();
                return view('auth.verify',compact('categories'));
            }
            else
            {
                $categories = Category::where('status','1')->get();

                $old_cartItems = Carts::where('user_id',Auth::id())->get();

                foreach($old_cartItems as $item)
                {
                    if(!Product::where('id', $item->product_id)->where('stocks','>=',$item->product_qty)->first())
                    {
                    $removeItem = Carts::where('user_id', Auth::user()->id)
                                        ->where('product_id', $item->product_id)->first();
                    $removeItem->delete();
                    }
                }
                $cartItems = Carts::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
                $deliveryAdresses = Address::deliveryAdresses();

                return view('frontend.new-checkout',compact('cartItems','categories','deliveryAdresses'));
            }
        }
    }
    public function add_address(Request $request)
    {
        $this->validate($request, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'string', 'max:13'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'detailed_address' => ['required', 'string', 'max:255'],
        ]);

        // insert data to address table
        Address::create([
            'user_id' => $request->input('user_id'),
            'email' => $request->input('email'),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone_no' => $request->phone_no,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'postal_code' => $request->postal_code,
            'detailed_address' => rtrim($request->detailed_address, ','),

        ]);
        return back()->with('alert','New address has been added successfully.');
    }
    public function placeOrderMailable($name, $total, $tracking_no,$address)
    {
        $order_data = [
            'name' => $name,
            'address' => $address,
            'total' => $total,
            'tracking_no' => $tracking_no,
            'payment_method' => 'Cash On Delivery',
        ];

        $items_in_cart = Carts::where('user_id', Auth::user()->id)->get();
        $cart_items = json_decode($items_in_cart, true);

        $to_customer_email = Auth::user()->email;
        Mail::to($to_customer_email)->send(new PlaceorderMailable($order_data, $items_in_cart));
    }
    public function placeOrder(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            if(empty($data['address_id']))
            {
                $message = "Please Select Delivery Address";
                session::flash('error_message',$message);
                return redirect()->back()->withInput($request->all());
            }
            elseif(empty($data['paymentMethod']))
            {
                $message = "Please Select Payment Method";
                session::flash('error_message',$message);
                return redirect()->back();
            }
            // print_r($data);die;

            if($data['paymentMethod'] == "COD")
            {
                $payment_method = "COD";

                // Get Delivery Address from address_id
                $deliveryAdresses = Address::where('id',$data['address_id'])->first()->toArray();

                // Insert Order Details
                $order = new Order();
                $order->user_id = Auth::user()->id;
                $order->fname = $deliveryAdresses['fname'];
                $order->lname = $deliveryAdresses['lname'];
                $order->email = Auth::user()->email;
                $order->address = $deliveryAdresses['detailed_address'];
                $order->barangay = $deliveryAdresses['barangay'];
                $order->city = $deliveryAdresses['city'];
                $order->postal_code = $deliveryAdresses['postal_code'];
                $order->phone_no = $deliveryAdresses['phone_no'];
                // To compute the total price
                $total = 0;
                $cartItems_total = Carts::where('user_id', Auth::user()->id)->get();
                foreach($cartItems_total as $prod)
                {
                    $total += $prod->products->price * $prod->product_qty;
                }

                $order->total_price = $total;
                $order->tracking_no = rand(1111,9999);

                $order->payment_method = $payment_method;
                $order->payment_gateway = $data['paymentMethod'];

                // dd($order);
                $order->save();


                // pass the items to order items table
                $cartItems = Carts::where('user_id', Auth::user()->id)->get();
                foreach($cartItems as $item)
                {
                OrderItem::create([
                        'order_id'=>$order->id,
                        'product_id' => $item->product_id,
                        'qty' => $item->product_qty,
                        'price' => $item->products->price,
                    ]);
                }

                $log = new OrdersLog;

                $log->order_id = $order->id;
                $log->order_status = 'Pending';
                $log->save();

                $tracking_no = $order->tracking_no;
                $name = $order->fname.' '. $order->lname;
                $address = $order->address.', '.$order->barangay.', '. $order->city.', '. $order->postal_code;

                // send mail
                $this->placeOrderMailable($name, $total, $tracking_no, $address);

                // delete items from cart
                Carts::where('user_id',Auth::user()->id)->delete();

                Session::put('order_id',$order->id);

                // real time notification
                $countCod = Order::where('status',0)->where('payment_method','=','COD')->count();
                $countOnline = Order::where('status',1)->where('payment_method','!=','COD')->count();

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

                $alert = 'New order has been placed. Payment Method: COD';
                event(new SendNotifyAlert($alert));
                // return to home page
                return redirect('/')->with('status', "Your order placed successfully!");
            }

            elseif($data['paymentMethod'] == "Paypal")
            {
                $payment_method = "Paypal";

                 // Get Delivery Address from address_id
                 $deliveryAdresses = Address::where('id',$data['address_id'])->first()->toArray();

                 $cartItems_total = Carts::where('user_id', Auth::user()->id)->get();
                 $total = 0;
                foreach($cartItems_total as $prod)
                {
                    $total += $prod->products->price * $prod->product_qty;
                }

                Session::put('total',$total);
                Session::put('deliveryAdresses',$deliveryAdresses);
                // dd($deliveryAdresses);
                return redirect('paypal');
            }
            else
            {
                $payment_method = "GCash";

                // Get Delivery Address from address_id
                $deliveryAdresses = Address::where('id',$data['address_id'])->first()->toArray();

                $cartItems_total = Carts::where('user_id', Auth::user()->id)->get();
                $total = 0;
                foreach($cartItems_total as $prod)
                {
                    $total += $prod->products->price * $prod->product_qty;
                }

                Session::put('total',$total);
                Session::put('deliveryAdresses',$deliveryAdresses);

                Session::put('gcash',$payment_method);
                return redirect('gcash');
            }
        }
    }
}
