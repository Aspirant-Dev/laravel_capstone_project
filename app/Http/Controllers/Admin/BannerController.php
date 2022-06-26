<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Image;
use App\Banner;

use Illuminate\Support\Facades\File;
class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index()
    {
        $banners = Banner::all();
        return view('admin.pages.banner.index',compact('banners'));
    }
    public function add()
    {
        return view('admin.pages.banner.add');
    }
    public function insert(Request $request)
    {
        $this->validate($request,[
            'banner_image' => 'required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'
        ]);

        $new_banner = new Banner();

        $new_banner->title = $request->input('title');
        $new_banner->subtitle = $request->input('subtitle');


        $image = $request->file('banner_image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        // not deployed
        // $destinationPath = public_path('uploads/banners');
        // deployed
        $destinationPath = '/home/u903542296/domains/realvalueenterprise.online/public_html/uploads/banners';
        $resize_image = Image::make($image->getRealPath());

        // resizeCanvas(200, 200, 'center', false, array(255, 255, 255, 0))

        $resize_image->resize(1170, 500, function($constraint){
            $constraint->upsize();
        })->save($destinationPath.'/'. $image_name);

        $image_w480 = $request->file('banner_image');
        $image_w480_name = $image_name;
        // not deployed
        // $w480DestinationPath = public_path('uploads/banners/w480');
        // deployed
        $w480DestinationPath = '/home/u903542296/domains/realvalueenterprise.online/public_html/uploads/banners/w480';
        $resize_image = Image::make($image->getRealPath());

        $resize_image->resize(480, 400, function($constraint){
            $constraint->upsize();
        })->save($w480DestinationPath.'/'. $image_w480_name);

        $new_banner->status = $request->input('status') == TRUE ? '1':'0';
        $new_banner->image_w480 = $image_w480_name;
        $new_banner->image = $image_name;
        $new_banner->save();

        return redirect()->route('admin.banners')->with('alert','New Banner has been added successfully');
    }
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.pages.banner.edit',compact('banner'));
    }
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);

        if($request->hasFile("banner_image"))
        {
            // not deployed
            // $path = 'uploads/banners/'.$banner->image;
            // $path_w480 = 'uploads/banners/w480/'.$banner->image_w480;
            // deployed
            $path = '/home/u903542296/domains/realvalueenterprise.online/public_html/uploads/banners/'.$banner->image;
            $path_w480 = '/home/u903542296/domains/realvalueenterprise.online/public_html/uploads/banners/w480/'.$banner->image_w480;

            if(File::exists($path))
            {
                File::delete($path);
            }
            if(File::exists($path_w480))
            {
                File::delete($path_w480);
            }
            $image = $request->file('banner_image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            // not deployed
            // $destinationPath = public_path('uploads/banners');
            // deployed
            $destinationPath ='/home/u903542296/domains/realvalueenterprise.online/public_html/uploads/banners';
            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(1170, 500, function($constraint){
                $constraint->upsize();
            })->save($destinationPath.'/'. $image_name);

            $image_w480 = $request->file('banner_image');
            $image_w480_name = $image_name;
            // not deployed
            // $w480DestinationPath = public_path('uploads/banners/w480');
            // deployed
            $w480DestinationPath = '/home/u903542296/domains/realvalueenterprise.online/public_html/uploads/banners';
            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(480, 400, function($constraint){
                $constraint->upsize();
            })->save($w480DestinationPath.'/'. $image_w480_name);

            $banner->image_w480 = $image_w480_name;
            $banner->image = $image_name;
        }
        $banner->title = $request->input('title');
        $banner->subtitle = $request->input('subtitle');

        $banner->status = $request->input('status') == TRUE ? '1':'0';
        $banner->update();

        return back()->with('alert','Banner updated successfully');
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $banner = Banner::find($id);
        $banner->delete();

        return response()->json(['status' => 'Banner has been deleted!','icon'=>'success']);
    }
}
