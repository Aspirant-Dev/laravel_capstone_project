<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Wishlist;
use App\Product;
use App\Category;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' =>['addtowish','wishlistCount']]);
    }
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('frontend.wishlist',compact('wishlist'));
    }
    public function addtowish(Request $request)
    {
        if(Auth::check())
        {

                if(Wishlist::where('product_id',$request->product_id)->where('user_id',Auth::user()->id)->exists())
                {
                    return response()->json(['status'=> $request->name.' is Already Added to your Wishlist','icon'=> 'info']);
                }
                else
                {
                    $wish = new Wishlist;
                    $wish->user_id = Auth::user()->id;
                    $wish->cate_id = $request->cate_id;
                    $wish->product_id = $request->product_id;
                    $getId = Category::where('id', $wish->products->cate_id)->first();
                    $wish->cate_id = $getId->id;
                    // $wish->deleted_at = null;
                    $wish->save();

                    return response()->json(['status'=> $request->name.' is Successfully Added to your Wishlist','icon'=> 'success']);
                }
        }
        else
        {
            return response()->json(['status'=> 'Login to Continue','icon'=> 'info']);
        }
    }

    public function removeWish(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $wishItem = Wishlist::where('product_id', $prod_id)->where('user_id',Auth::user()->id)->first();
        $wishItem->forceDelete();

        return response()->json(['status'=> $request->input('name').' Successfully deleted to your Wishlist']);
    }
    public function updateWish(Request $request)
    {
        $place_id = $request->get('city_id');
        // do database operations required
        return 'success';
        $prod_id = $request->input('prod_id');
        $prod_qty = $request->input('prod_qty');

        if(Wishlist::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->exists())
        {
            $cart = Wishlist::where('product_id',$prod_id)->where('user_id',Auth::user()->id)->first();
            $cart->product_qty = $prod_qty;
            $cart->update();

            $cartItems = Wishlist::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();

            $grandTotal = 0;
            foreach($cartItems as $item)
            {
                $totalPrice = $item->products->price*$item->product_qty;
                $grandTotal += $item->products->price*$item->product_qty;
            }
            return response()->json(['status'=> 'Quantity Updated','totalPrice' => number_format($totalPrice,2), 'gTotal' => $grandTotal]);
        }
    }
    public function clearWishlist(Request $request)
    {

        $counter = Wishlist::where('user_id',Auth::user()->id)->count();
        Wishlist::where('user_id',Auth::user()->id)->delete();

        if($counter > 1)
        {
            return response()->json(['status'=> $counter.' items successfully deleted in your cart!']);
        }
        else
        {
            return response()->json(['status'=> $counter.' item successfully deleted in your cart!']);
        }
    }
    public function wishlistCount()
    {
        if(Auth::check())
        {
            $wishlistcount = Wishlist::where('user_id',Auth::user()->id)->count();

            return response()->json(['wishcount'=> $wishlistcount]);
        }
    }
}
