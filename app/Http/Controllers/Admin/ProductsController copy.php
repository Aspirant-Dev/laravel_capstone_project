<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Product;
use App\Category;
use App\ProductUnit;
use App\Wishlist;
use App\Carts;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
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
                $products = Product::orderBy('id','DESC')->get();
                return view('admin.pages.products', compact('products'));
            }
            else{
                return back()->with('info','Unauthorized Account');
            }
        }
    }
    public function index1()
    {
        $products = Product::whereRaw('stocks <= critical_level')->get();
        return view('admin.pages.product.show_critical_stocks', compact('products'));
    }
    public function add()
    {
        $units = ProductUnit::all();
        $category = Category::all();
        $unique_code = 'P-'.rand(date('ymj',time()),999999);
        return view('admin.pages.product.add',compact('category','units','unique_code'));
    }
    public function insert(Request $request)
    {
        $product = new Product();
        if (Product::where('name', '=', Input::get('name'))->count() > 0) {
            return back()->with('alert','Product Name: '.$request->input('name').' is already exists.')->withInput($request->all());
         }
        elseif(Product::where('p_code', '=', Input::get('p_code'))->count() > 0)
        {
            $unique_code = 'P-'.rand(111111,999999);
        }
        elseif ($request->only('cate_id','pcode','name','brand','type','description','price','stocks','critical_level','unit') == '')
        {
            return back()->with('alert','All fields are required')->withInput($request->all());
        }
        elseif($request->file('image') == null)
        {
            return back()->with('alert','All fields are required')->withInput($request->all());
        }
        else
        {
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('uploads/products/',$filename);
                $product->image = $filename;
            }
            $product->cate_id = $request->input('cate_id');
            $cate_name = Category::where('id',$request->input('cate_id'))->first();
            $product->cate_name = $cate_name->name;
            $product->p_code = $request->input('pcode');
            // $name = strtolower($request->input('name'));
            // $product->name = ucwords($name);
            $product->name = ucfirst($request->input('name'));
            $product->slug = str_replace(' ', '-', strtolower($request->input('name')));
            $product->brand = $request->input('brand');
            $product->product_type = $request->input('type');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->stocks = $request->input('stocks');
            $product->critical_level = $request->input('critical_level');
            $product->unit = $request->input('unit');
            $product->status = $request->input('status') == TRUE ? '1':'0';
            $product->trending = $request->input('trending') == TRUE ? '1':'0';
            $product->returnable = $request->input('returnable') == TRUE ? '1':'0';
            $product->meta_title = $request->input('meta_title');
            $product->meta_keywords = $request->input('meta_keywords');
            $product->meta_description = $request->input('meta_description');
            $product->save();
            return redirect('/admin/products')->with('alert', 'Product Added Successfully');
        }
    }
    public function edit($id)
    {

        $categories = Category::all();
        $units = ProductUnit::all();
        $product = Product::find($id);
        return view('admin.pages.product.edit',compact('product','units','categories'));
    }
    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        if($request->hasFile("image"))
        {
            $path = 'uploads/products/'.$product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/products/',$filename);
            $product->image = $filename;
        }

        $product->cate_id = $request->input('cate_id');
        $cate_name = Category::where('id',$request->input('cate_id'))->first();
        $product->cate_name = $cate_name->name;
        $product->p_code = $request->input('pcode');
        // $name = strtolower($request->input('name'));
        // $product->name = ucwords($name);
        $product->name = ucfirst($request->input('name'));
        $product->slug = str_replace(' ', '-', strtolower($request->input('name')));
        $product->brand = ucwords($request->input('brand'));
        $product->product_type = ucwords($request->input('type'));
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stocks = $request->input('stocks');
        $product->critical_level = $request->input('critical_level');
        $product->unit = $request->input('unit');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->returnable = $request->input('returnable') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_description = $request->input('meta_description');

        $product->update();

        return redirect('/admin/products')->with('alert', 'Product Updated Successfully');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->image)
        {
            $path = 'uploads/products/'.$product->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('/admin/products')->with('alert', 'Product Deleted Successfully');
    }
    public function delete(Request $request)
    {
        if(Auth::user()->user_type == 'Admin')
        {
            $id = $request->input('id');
            $a = Product::find($id);
            $usersWishlist = Wishlist::where('product_id',$id)->get();
            foreach($usersWishlist as $item)
            {
                $item->delete();
            }
            $userCarts = Carts::where('product_id',$id)->get();
            foreach($userCarts as $itemCart)
            {
                $itemCart->delete();
            }
            $a->delete();
            return response()->json(['status' => 'Product has been deleted!','icon'=>'success']);
        }
        else
        {
            return response()->json(['status' => 'You do not have access to delete a product','icon'=>'error']);
        }
    }

}
