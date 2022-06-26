<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Product;
use App\Rating;
use App\Order;
use Session;
use App\Events\RatingSubmitted;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if(!Auth::check())
            {
                return back()->with('failed','Login to rate this product.');
            }

            // $ratingCount = Rating::where(['user_id'=>Auth::user()->id,'product_id'=>$data['prod_id']])->count();
            // if($ratingCount > 0 )
            // {
            //     return back()->with('failed','Your rating already exists for this product.');
            // }
            else
            {
                $verified_purchase = Order::where('orders.user_id', Auth::user()->id)
                                        ->join('order_items', 'orders.id','order_items.order_id')
                                        ->where('orders.status','3')
                                        ->where('order_items.product_id', $data['prod_id'])->get();

                if($verified_purchase->count() > 0)
                {
                    $ratingCount = Rating::where(['user_id'=>Auth::user()->id,'product_id'=>$data['prod_id']])->first();
                    if($ratingCount)
                    {
                        $ratingCount->review = $data['review'];

                        if (empty($data['rating']))
                        {
                            return redirect()->back()->with('failed','Please add atleast one star to continue.');
                        }
                        else
                        {
                            $ratingCount->rating = $data['rating'];
                        }
                        $ratingCount->update();
                        return back()->with('failed','Since it already exists, your rating and review have been updated.');
                    }
                    else
                    {
                        $rating = new Rating();
                        $rating->user_id = Auth::user()->id;
                        $rating->product_id = $data['prod_id'];
                        $rating->review = $data['review'];
                        if (empty($data['rating']))
                        {
                            return redirect()->back()->with('failed','Please add atleast one star to continue.');
                        }
                        else
                        {
                            $rating->rating = $data['rating'];
                        }
                        $rating->status = 1;
                        $rating->save();

                        $name = Rating::where('id',$rating->id)->where('user_id',$rating->user_id)->first();
                        $product = Rating::where('id',$rating->id)->where('product_id',$rating->product_id)->first();
                        $text = $name->user->username.' rated and reviewed the '. $product->product->name.'.';

                        event(new RatingSubmitted($text));
                        return redirect()->back()->with('status1','Thank you for rating this product!');
                    }
                }
                else
                {
                    return redirect()->back()->with('failed','You cannot rate a product without purchase');
                }
            }
        }
    }
}
