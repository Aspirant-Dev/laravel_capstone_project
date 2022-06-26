<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\Category;

use App\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class ProductsController1 extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index()
    {
        if(Auth::user()->user_type == 'Admin')
        {
            $products = Product::all();
            return view('admin.pages.products', compact('products'));
        }
        else
        {
            return back()->with('info','Unauthorized Account');
        }
    }
    public function index1()
    {
        $products = Product::whereRaw('stocks <= critical_level')->get();
        return view('admin.pages.product.show_critical_stocks', compact('products'));
    }
    public function add()
    {
        $category = Category::all();
        return view('admin.pages.product.add1',compact('category'));
    }
    public function insert(Request $request)
    {
        $this->validate($request, [
            'cate_id' => ['required', 'string', 'max:255'],
            'product_code' => ['required', 'string', 'max:255', 'unique:products,p_code'],
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'product_price' => ['required','numeric', 'min:10'],
            'product_stocks' => ['required','numeric', 'min:10'],
            'products_critical_level' => ['required','numeric', 'min:1'],
            'unit' => ['required', 'string', 'max:255'],
            'status' => ['accepted', 'string', 'max:1'],
            'trending' => ['accepted', 'string', 'max:255'],
            'product_description' => ['required', 'string', 'max:1000'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],

        ]);

        $product = new Product();


            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('uploads/products/',$filename);
                $product->image = $filename;
            }
            $product->cate_id = $request->input('cate_id');
            $product->p_code = $request->input('pcode');
            $product->name = $request->input('name');
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
            $product->meta_title = $request->input('meta_title');
            $product->meta_keywords = $request->input('meta_keywords');
            $product->meta_description = $request->input('meta_description');
            $product->save();
            return redirect('/admin/products')->with('alert', 'Product Added Successfully');

    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.pages.product.edit',compact('product'));
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

        $product->p_code = $request->input('pcode');
        $product->name = $request->input('name');
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
            $a = Product::where('id',$id)->first();
            $a->delete();
            return response()->json(['status' => 'Product has been deleted!','icon','success']);
        }
        else
        {
            return response()->json(['status' => 'You do not have access to delete an account','icon'=>'error']);
        }
    }
}
