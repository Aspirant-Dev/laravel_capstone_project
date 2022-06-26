<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\File;
use App\Product;
use App\Order;
use App\Carts;
use App\OrderItem;
use App\Category;
use App\OrdersLog;
use App\ReturnedProducts;
use Carbon\Carbon;

use App\Events\ReturnedSubmitted;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $orders = Order::latest()->where('user_id', Auth::user()->id)->paginate(5);
        $categories = Category::where('status','1')->get();
        return view('frontend.orders.index',compact('orders','categories'));
    }
    public function pending()
    {
         // Status 0 means Pending Orders
         $orders = Order::where('user_id', Auth::user()->id)->where('status',0)->orderBy('id','DESC')->paginate(5);
        $categories = Category::where('status','1')->get();
        return view('frontend.orders.index',compact('orders','categories'));
    }
    public function processing_orders()
    {
        // Status 1 means Processing Orders
        $orders = Order::where('user_id', Auth::user()->id)->where('status',1)->orderBy('id','DESC')->paginate(5);
        $categories = Category::where('status','1')->get();
        return view('frontend.orders.index',compact('orders','categories'));
    }
    public function delivery()
    {
        // Status 2 means For Delivery Orders
        $orders = Order::where('user_id', Auth::user()->id)->where('status',2)->orderBy('id','DESC')->paginate(5);
        $categories = Category::where('status','1')->get();
        return view('frontend.orders.index',compact('orders','categories'));
    }
    public function completed()
    {
        // Status 3 means Delivered Orders
        $orders = Order::where('user_id', Auth::user()->id)->where('status',3)->orderBy('id','DESC')->paginate(5);
        $categories = Category::where('status','1')->get();



        return view('frontend.orders.index',compact('orders','categories'));
    }
    public function cancelled()
    {
        // Status 4 means Cancelled Orders
        $orders = Order::where('user_id', Auth::user()->id)->where('status',4)->orderBy('id','DESC')->paginate(5);
        $categories = Category::where('status','1')->get();
        return view('frontend.orders.index',compact('orders','categories'));
    }

    public function view(Request $request, $id)
    {
        if(Order::where('id', $id)->exists())
        {
            $prods = Product::all();
            $orders = Order::where('id','=',$id)->where('user_id', Auth::user()->id)->first();
            $categories = Category::where('status','1')->get();
            $item_id = OrderItem::find($id);
            $returnedItem = ReturnedProducts::where('order_id',$id)->where('user_id', Auth::user()->id)->first();

            return view('frontend.orders.view',compact('orders','categories','prods','returnedItem'));
        }
        else{
            return redirect('/')->with('not-found','We could not find the page you were looking for.');
        }
    }
    public function cancel_order($id)
    {
        $orders = Order::find($id);

        $orders->status = '4';

        $orders->update();

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
        elseif ($orders->status == 5) {
            $order_status = 'Retuned';
        }

        $log->order_id = $orders->id;
        $log->order_status = $order_status;
        $log->updated_by = Auth::user()->fname.' '.Auth::user()->lname.' (User)';
        $log->save();

        $categories = Category::where('status','1')->get();
        return redirect()->back()->with('alert-cancel','Successfully cancelled order',compact('orders','categories'));
    }
    public function request_return_item(Request $request, $order_id, $item_id)
    {
        $order_id = Order::find($order_id);
        $item_id = OrderItem::find($item_id);

        $item_id->status = 1; // for requesting return item
        $item_id->update();

        $returnItem = new ReturnedProducts();
        $returnItem->order_id = $order_id->id;
        $returnItem->item_id = $item_id->id;
        $returnItem->user_id = Auth::user()->id;
        $returnItem->product_id = $item_id->product_id;
        $returnItem->reason = $request->input('reason');
        $returnItem->quantity = $request->input('quantity');


        if($request->hasFile("prod_image"))
        {
            $file = $request->file("prod_image");
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/return/',$filename);
            $returnItem->product_image = $filename;
            // dd($filename);
        }
        if($request->hasFile("receipt_image"))
        {
            $file = $request->file("receipt_image");
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/return_image_receipt/',$filename);
            $returnItem->image_receipt = $filename;
        }
        $returnItem->detailed_reason = $request->input('detailed_reason');
        $returnItem->save();

        $text = ReturnedProducts::all()->count();
        event(new ReturnedSubmitted($text));

        return back()->with('request', 'You are requesting for returning '.$item_id->products->name.'.');
    }
}
