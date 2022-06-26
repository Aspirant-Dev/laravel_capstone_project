<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\ProductUnit;

use App\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class ProductsUnitController extends Controller
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
                $units = ProductUnit::all();
                return view('admin.pages.products-unit', compact('units'));
            }
            else{
                return back()->with('info','Unauthorized Account');
            }
        }
    }
    public function add()
    {
        return view('admin.pages.product-unit.add');
    }
    public function insert(Request $request)
    {
        $this->validate($request, [ 'name' => 'required','string', 'max:255']);

        if(ProductUnit::where('unit_name', '=', $request->input('name'))->count() > 0)
        {
            return back()->with('invalid','This unit name is already exists.')->withInput(Input::all());
        }
        else
        {
            $units = new ProductUnit();
            $units->unit_name = ucfirst($request->input('name'));
            $units->description = $request->input('description');
            $units->save();

            return redirect('/admin/products-unit')->with('alert', 'Product Unit Added Successfully');
        }
    }
    public function edit($id)
    {
        $units = ProductUnit::find($id);
        return view('admin.pages.product-unit.edit',compact('units'));
    }
    public function update(Request $request, $id)
    {
        $units = ProductUnit::find($id);
        $units->unit_name = ucfirst($request->input('name'));
        $units->description = $request->input('description');;
        $units->update();
        return redirect('/admin/products-unit')->with('alert', 'Product Unit Updated Successfully');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $units = ProductUnit::find($id);
        $units->delete();

        return response()->json(['status' => $name.' Unit has been deleted!','icon'=>'success']);
    }
}
