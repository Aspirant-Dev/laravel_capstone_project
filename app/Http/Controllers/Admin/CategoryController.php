<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Wishlist;
use App\Carts;
use Auth;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    //
    public function index()
    {
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'Admin')
            {
                $cats = Category::orderBy('id','DESC')->get();
                return view('admin.pages.category',compact('cats'));
            }
            else
            {
                return redirect()->back();
            }
        }
    }
    public function add()
    {
        return view('admin.pages.category.add');
    }
    public function insert(Request $request)
    {
        $category = new Category();

        if (Category::where('name', '=', Input::get('name'))->count() > 0) {
            return redirect('/admin/categories')->with('invalid','Category Name: '.$request->input('name').' is already exists.');
        }
        else
        {
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('uploads/categories/',$filename);
                $category->image = $filename;
            }

            $category->name = $request->input('name');
            $category->slug = str_replace(' ', '-', strtolower($request->input('name')));
            $category->description = $request->input('description');
            $category->status = $request->input('status') == TRUE ? '1':'0';
            $category->popular = $request->input('popular') == TRUE ? '1':'0';;
            // $category->meta_title = $request->input('meta_title');
            // $category->meta_keywords = $request->input('meta_keywords');
            // $category->meta_description = $request->input('meta_description');
            $category->save();
            return redirect('/admin/categories')->with('alert', 'Category Added Successfully');

        }

    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.pages.category.edit',compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($request->hasFile("image"))
        {
            $path = 'uploads/categories/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/categories/',$filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = str_replace(' ', '-', strtolower($request->input('name')));
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular') == TRUE ? '1':'0';;
        // $category->meta_title = $request->input('meta_title');
        // $category->meta_keywords = $request->input('meta_keywords');
        // $category->meta_description = $request->input('meta_description');
        $category->update();

        return redirect('/admin/categories')->with('alert', 'Category Updated Successfully');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->image)
        {
            $path = 'uploads/categories/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('/admin/categories')->with('alert', 'Category Deleted Successfully');
    }
    public function delete(Request $request)
    {
        if(Auth::user()->user_type == 'Admin')
        {
            $id = $request->input('id');
            $a = Category::find($id);

            $prods = Product::where('cate_id',$id)->get();
            foreach($prods as $itemProds)
            {
                $itemProds->delete();
            }
            $usersWishlist = Wishlist::where('cate_id',$id)->get();
            foreach($usersWishlist as $item)
            {
                $item->delete();
            }
            $userCarts = Carts::where('category_id',$id)->get();
            foreach($userCarts as $itemCart)
            {
                $itemCart->delete();
            }

            $a->delete();
            return response()->json(['status' => 'Category has been deleted!','icon'=>'success']);
        }
        else
        {
            return response()->json(['status' => 'You do not have access to delete a category','icon'=>'error']);
        }
    }
}
