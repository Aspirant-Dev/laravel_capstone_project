<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rating;

class RatingController extends Controller
{
    //
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
                $rating = Rating::with(['user','product'])->get();
                // dd($ratings);
                return view('admin.pages.ratings.index',compact('rating'));
            }
            else
            {
                return back();
            }
        }
    }
    public function updateRatingStatus(Request $request)
    {
        if(Auth::user()->user_type == 'Admin')
        {
            if($request->ajax())
            {
                $data = $request->all();
                if($data['status']=="Active")
                {
                    $status = 0;
                }
                else
                {
                    $status = 1;
                }
                Rating::where('id',$data['rating_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'rating_id'=>$data['rating_id']]);
            }
        }
    }
}
