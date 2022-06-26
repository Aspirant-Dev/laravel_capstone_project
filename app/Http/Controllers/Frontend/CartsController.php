<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Product;
use App\Order;
use App\Carts;
use App\OrderItem;
use App\Category;


class CartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' =>['addtocart','cartCount']]);
    }
    public function viewCart()
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
                $cartItems = Carts::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
                return view('frontend.cart', compact('cartItems','categories'));
            }
        }
        else
        {
            return redirect('/login');
        }
    }
    public function addtocart(Request $request)
    {

        if(Auth::check())
        {
            if(!Auth::user()->hasVerifiedEmail())
            {
                return response()->json(['status'=> 'Please verify your email to continue','icon'=> 'info']);
            }
            else
            {
                $product_qty = $request->input('quantity');
                $prod_stock = $request->input('prod_stock');
                $cat_id = $request->input('category_id');

                $test = Carts::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->first();
                if(Carts::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->exists())
                {
                    if($test->product_qty >= $prod_stock)
                    {
                        return response()->json(['status'=> $request->name.' is out of stock. You have '. $test->product_qty .' in your cart','icon'=>'info']);
                    }
                    elseif($product_qty <= '0')
                    {
                        return response()->json(['status'=> 'Invalid quantity','status1'=> 'Please input quantity to add this in your cart','icon'=> 'error']);
                    }
                    elseif($product_qty > $prod_stock)
                    {
                        return response()->json(['status'=> 'Sorry, Out of stock.','icon'=> 'error']);
                    }
                    else
                    {
                        // if(Carts::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->where('product_qty', '>',$prod_stock )->get())
                        // {
                        //     $cart = Carts::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->first();
                        //     $cart->product_qty = $prod_stock;
                        //     $cart->update();
                        //     return response()->json(['status'=> $request->name.' already added to cart','icon'=>'info']);
                        // }
                        // else
                        // {
                        //     $cart = Carts::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->first();
                        //     $cart->product_qty = $cart->product_qty + $product_qty;
                        //     $cart->update();
                        //     return response()->json(['status'=> $request->name.' already added to cart','icon'=>'info']);
                        // }
                        $cart = Carts::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->first();
                        $cart->product_qty = $cart->product_qty + $product_qty;
                        $cart->update();
                        if($cart->product_qty > $prod_stock)
                        {
                            $cart->product_qty = $prod_stock;
                            $cart->update();
                        }
                        return response()->json(['status'=> $request->name.' already added to cart','icon'=>'info']);
                    }
                }
                else{
                    if($product_qty <= '0')
                    {
                        return response()->json(['status'=> 'Invalid quantity','status1'=> 'Please input quantity to add this in your cart','icon'=> 'error']);
                    }
                    elseif($product_qty > $request->prod_stock)
                    {
                        return response()->json(['status'=> 'Sorry','status1'=> 'Out of stock.','icon'=> 'error']);
                    }
                    else
                    {
                        $cart = new Carts;
                        $cart->user_id = Auth::user()->id;
                        $cart->product_id = $request->product_id;
                        $cart->product_qty = $product_qty;
                        $getId = Category::where('id', $cart->products->cate_id)->first();
                        $cart->category_id = $getId->id;
                        $cart->save();

                        return response()->json(['status'=> $request->name.' is Successfully Added to your Cart','icon'=> 'success']);
                    }
                }
            }
        }
        else
        {
            return response()->json(['status'=> 'Login to Continue','icon'=> 'info']);
        }
    }
    public function updateCartItem(Request $request, $id)
    {
        $cartItem = Carts::find($id);
        $name = $cartItem->products->name;
        $cartItem->product_qty = $request->input('quantity');
        $cartItem->update();
        return back()->with('success', 'Quantity has been updated successfully');
    }
    public function removeCart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $cartItems = Carts::where('product_id', $prod_id)->where('user_id',Auth::user()->id)->first();
        $cartItems->forceDelete();

        return response()->json(['status'=> $request->input('name').' Successfully deleted to your Cart']);
    }
    public function updateCart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $prod_qty = $request->input('prod_qty');

        if(Carts::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->exists())
        {
            $cart = Carts::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->first();
            $cart->product_qty = $prod_qty;
            $cart->update();

            $cartItems = Carts::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();

            $grandTotal = 0;
            foreach($cartItems as $item)
            {
                $totalPrice = $item->products->price*$item->product_qty;
                $grandTotal += $item->products->price*$item->product_qty;
            }
            return response()->json(['status'=> 'Quantity Updated','totalPrice' => number_format($totalPrice,2), 'gTotal' => $grandTotal]);
        }
    }
    public function clearCart(Request $request)
    {

        $counter = Carts::where('user_id',Auth::user()->id)->count();
        Carts::where('user_id',Auth::user()->id)->forceDelete();

        if($counter > 1)
        {
            return response()->json(['status'=> $counter.' items successfully deleted in your cart!']);
        }
        else
        {
            return response()->json(['status'=> $counter.' item successfully deleted in your cart!']);
        }
    }
    public function cartCount()
    {
        if(Auth::check())
        {
            $cartcount = Carts::where('user_id',Auth::user()->id)->count();
            return response()->json(['count'=> $cartcount]);
        }
    }

}
