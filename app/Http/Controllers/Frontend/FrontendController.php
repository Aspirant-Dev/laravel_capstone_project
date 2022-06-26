<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\Rating;
use Response;
use App\Order;
// use Request;
use Illuminate\Support\Facades\DB;
use App\Events\FormSubmitted;

class FrontendController extends Controller
{
    public function pusher()
    {
        $count = Order::where('user_id',Auth::user()->id)->get()->count();
        $pe = Order::where('user_id',Auth::user()->id)->where('status',0)->get()->count();
        $pr = Order::where('user_id',Auth::user()->id)->where('status',1)->get()->count();
        $fd = Order::where('user_id',Auth::user()->id)->where('status',2)->get()->count();
        $de = Order::where('user_id',Auth::user()->id)->where('status',3)->get()->count();
        $ca = Order::where('user_id',Auth::user()->id)->where('status',4)->get()->count();
        return view('welcome',compact('count','pe','pr','fd','de','ca'));
    }
    public function index()
    {
        // $cats = Category::withCount('products')->get();
        // echo $cats;

        $featured_products = Product::where('trending','1')->where('status','1')->take(12)->get();
        $categories = Category::where('status','1')->get();
        $all_prods = Product::latest()->paginate(10);
        $new_arrival = Product::where('status','1')->where('stocks','>',0)->orderBy('id','DESC')->take(10)->get();
        return view('layouts.frontend.index',compact('featured_products','categories','new_arrival','all_prods'));
    }
    public function shop(Request $request)
    {

        $a = array(
            array(
              'id' => 1,
              'val' => 'ASC',
              'name' => 'Price - Low to High',
            ),
            array(
              'id' => 2,
              'val' => 'DESC',
              'name' => 'Price - High to Low',
            ),
          );

        $max_price = Product::max('price');
        $products = Product::where('status',1)->get();
        if($request->get('filterprods'))
        {
            $checked = $_GET['filterprods'];
            $priceSort = $request->get('filterprodsP');

            $products = Product::whereIn('brand',$checked)
                                ->orwhereIn('cate_name',$checked)
                                ->where('status',1)->orderBy('price',$priceSort[0])->get();
        }
        return view('frontend.shop',compact('max_price','products','a'));
    }
    public function all_categories()
    {
        $categories = Category::where('status','1')->get();
        return view('frontend.categories.index',compact('categories'));

    }
    public function view_category($slug)
    {
        if(Category::where('slug', $slug)->exists())
        {

            $categories = Category::where('status','1')->get();
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cate_id', $category->id)->where('status','1')->get();

            $featured_products = Product::where('trending','1')->where('status','1')->take(12)->get();
            return view('frontend.products.index',compact('category','products','categories','featured_products'));
        }
        else
        {
            return redirect('/')->with('not-found','We could not find the page you were looking for.');
        }
    }
    public function view_product($cate_slug, $prod_slug)
    {
        if(Category::where('slug', $cate_slug)->exists())
        {
            if(Product::where('slug', $prod_slug)->exists())
            {
                $categories = Category::where('status','1')->get();
                $category = Category::where('slug', $cate_slug)->first();
                $featured_products = Product::where('trending','1')->where('status','1')->take(12)->get();
                $rel_products = Product::where('cate_id', $category->id)->where('status','1')->get();
                $products = Product::where('slug', $prod_slug)->first();

                $ratings = Rating::latest()->where('status',1)->where('product_id',$products->id)->get();

                // Get the average rating of product
                $ratingSum = Rating::where('status',1)->where('product_id',$products->id)->sum('rating');
                $ratingCount = Rating::where('status',1)->where('product_id',$products->id)->count();
                if($ratingCount > 0)
                {
                    $avgRating = round($ratingSum/$ratingCount,2);
                    $avgStarRating = round($ratingSum/$ratingCount);
                }
                else
                {
                    $avgRating = 0;
                    $avgStarRating = 0;
                }

                return view('frontend.products.view',compact('products','categories','rel_products','category','ratings','avgRating','avgStarRating','featured_products'));
            }
            else
            {
                return redirect('/')->with('not-found',"We could not find the page you were looking for.");
            }
        }
        else
        {
            return redirect('/')->with('not-found',"We could not find the page you were looking for.");
        }
    }
    public function about_us()
    {
        return view('frontend.about-us');
    }
    public function privacy_policy()
    {
        return view('frontend.privacy');
    }
    public function terms()
    {
        return view('frontend.terms');
    }
    public function print()
    {
        return Response::download('assets/landing_page/assets/logo.png' );
    }
}
