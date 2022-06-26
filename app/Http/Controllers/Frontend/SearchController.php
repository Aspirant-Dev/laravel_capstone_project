<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use App\Rating;
use Response;

class SearchController extends Controller
{
    public function searchAutoComplete(Request $request)
    {
        $query = $request->get('term','');

        $products = Product::where('name','LIKE','%'.$query.'%')
                            ->orWhere('brand', 'like', '%'.$query.'%')
                            ->orWhere('cate_name', 'like', '%'.$query.'%')
                            ->orWhere('product_type', 'like', '%'.$query.'%')
                            ->orWhere('unit', 'like', '%'.$query.'%')
                            ->get();

        $data = [];
        foreach ($products as $item)
        {
            $data[] = [
                'value' => $item->name,
                'id'=> $item->id
            ];
        }
        if(count($data))
        {
            return $data;
        }
        else
        {
            return ['value'=>'No Result Found','id'=>0];
        }
    }
    public function result(Request $request)
    {
        $searchingData = $request->input('search_product');
        $products = Product::where('name','LIKE','%'.$searchingData.'%')->first();

        if($products)
        {
            return redirect('category/'.$products->category->slug.'/'.$products->slug);
        }
        else
        {
            return back()->with('search-failed','Product not available');
        }
    }
}
