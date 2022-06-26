<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\ProductUnit;
use App\Admin;
use App\Banner;
use App\Wishlist;
use App\Carts;

class TrashController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    public function banners_index()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {
                $banners = Banner::onlyTrashed()->get();

                return view('admin.pages.trashed.banners',compact('banners'));

            }
            else{
                return back();
            }
        }
    }
    public function banner_restore($id)
    {
        $x = Banner::withTrashed()->find($id);
        $x->restore();
        return back()->with('restored', 'Banner successfully restored.');
    }
    public function banner_delete($id)
    {
        // $id = $request->input('id');
        Banner::withTrashed()->find($id)->forceDelete();
        return back()->with('restored', 'Banner successfully deleted.');
    }
    public function restoreAllBanners()
    {
        $x = Banner::withTrashed()->restore();
        return back()->with('restored', 'All banners successfully restored.');
    }
    public function units_index()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {
                $units = ProductUnit::onlyTrashed()->get();

                return view('admin.pages.trashed.product-units',compact('units'));

            }
            else{
                return back()->with('info','Unauthorized Account');
            }
        }
    }
    public function units_restore($id)
    {
        $x = ProductUnit::withTrashed()->find($id);
        $x->restore();
        return back()->with('restored', $x->unit_name.' successfully restored.');
    }
    public function restoreAllUnits()
    {
         $x = ProductUnit::withTrashed()->restore();
        return back()->with('restored', 'All products units successfully restored.');
    }
    public function products_index()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {

                $products = Product::onlyTrashed()->orderBy('deleted_at','DESC')->get();
                return view('admin.pages.trashed.products',compact('products'));
            }
            else{
                return back()->with('info','Unauthorized Account');
            }
        }
    }
    public function products_restore($id)
    {
        $usersWishlist = Wishlist::withTrashed()->where('product_id',$id)->get();
            foreach($usersWishlist as $item)
            {
                $item->restore();
            }
            $userCarts = Carts::withTrashed()->where('product_id',$id)->get();
            foreach($userCarts as $itemCart)
            {
                $itemCart->restore();
            }
        $x = Product::withTrashed()->find($id);
        $x->restore();
        return back()->with('restored', $x->name.' successfully restored.');
    }
    public function restoreAllProducts()
    {
        $usersWishlist = Wishlist::withTrashed()->where('product_id',$id)->get();
            foreach($usersWishlist as $item)
            {
                $item->restore();
            }
            $userCarts = Carts::withTrashed()->where('product_id',$id)->get();
            foreach($userCarts as $itemCart)
            {
                $itemCart->restore();
            }
         $x = Product::withTrashed()->restore();
        return back()->with('restored', 'All products successfully restored.');
    }
    public function categories_index()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {
                $categories = Category::onlyTrashed()->get();
                return view('admin.pages.trashed.categories',compact('categories'));
            }
            else{
                return back()->with('info','Unauthorized Account');
            }
        }
    }
    public function categories_restore($id)
    {

        $prods = Product::withTrashed()->where('cate_id',$id)->get();
            foreach($prods as $itemProds)
            {
                $itemProds->restore();
            }
        $usersWishlist = Wishlist::withTrashed()->where('cate_id',$id)->get();
            foreach($usersWishlist as $item)
            {
                $item->restore();
            }
            $userCarts = Carts::withTrashed()->where('category_id',$id)->get();
            foreach($userCarts as $itemCart)
            {
                $itemCart->restore();
            }
        $x = Category::withTrashed()->find($id);
        $x->restore();

        return back()->with('restored', $x->name.' successfully restored.');
    }
    public function restoreAllCategories()
    {
        $prods = Product::withTrashed()->where('category_id',$id)->get();
            foreach($prods as $itemProds)
            {
                $itemProds->restore();
            }
        $usersWishlist = Wishlist::withTrashed()->where('cate_id',$id)->get();
            foreach($usersWishlist as $item)
            {
                $item->restore();
            }
            $userCarts = Carts::withTrashed()->where('cate_id',$id)->get();
            foreach($userCarts as $itemCart)
            {
                $itemCart->restore();
            }
         $x = Category::withTrashed()->restore();
        return back()->with('restored', 'All categories successfully restored.');
    }
    public function userAccounts_index()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {

                $admins = Admin::onlyTrashed()->get();
                return view('admin.pages.trashed.admin-user-accounts',compact('admins'));
            }
            else{
                return back()->with('info','Unauthorized Account');
            }
        }
    }
    public function userAccounts_restore($id)
    {
        $x = Admin::withTrashed()->find($id);
        $x->restore();
        return back()->with('restored', $x->username.' successfully restored.');
    }
    public function restoreAllUserAccount()
    {
         $x = Admin::withTrashed()->restore();
        return back()->with('restored', 'All categories successfully restored.');
    }
}
