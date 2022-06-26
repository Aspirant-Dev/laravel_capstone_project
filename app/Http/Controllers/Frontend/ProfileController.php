<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Product;
use App\Category;
use App\User;
use App\Address;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function dashboard()
    {
        return view('frontend.profile.dashboard');
    }
    public function index()
    {
        $categories = Category::where('status','1')->get();
        return view('frontend.profile',compact('categories'));
    }
    public function update_account(Request $request)
    {
        // dd($request->input('email'));

        $user_profile = User::where('id',Auth::user()->id)->first();
        if($request->input('current_email') == $request->input('email'))
        {
            return back()->with('error_email','Same email address.');
        }
        elseif(($request->input('email') != NULL) && ($request->input('current_password') == NULL) && ($request->input('password') == NULL) && ($request->input('password_confirmation') == NULL))
        {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users','unique:admins'],
            ]);
            $user_profile->fname = $request->input('fname');
            $user_profile->lname = $request->input('lname');
            $user_profile->email = $request->input('email');
            $user_profile->phone_no = $request->input('phone_no');
            $user_profile->update();

            return redirect()->back()->with('success','Profile has been successfully updated.');
        }
        elseif(($request->input('email') != NULL) && ($request->input('current_password') != NULL) && ($request->input('password') != NULL) && ($request->input('password_confirmation') != NULL) )
        {

            $request->validate([
                'current_password' => 'required','min:8',
                'password' => 'required','min:8',
                'password_confirmation' => 'required','min:8','same:password',
            ]);

            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users','unique:admins'],
            ]);

            if(Hash::check($request->current_password, $user_profile->password))
            {
                $user_profile->save([
                    'password' => bcrypt($request->password),
                ]);

                $user_profile->fname = $request->input('fname');
                $user_profile->lname = $request->input('lname');
                $user_profile->phone_no = $request->input('phone_no');
                $user_profile->email = $request->email;
                $user_profile->update();

                return back()->with('success','Profile has been successfully updated.');
            }
            else
            {
                return back()->with('error','Old password does not matched');
            }
        }
        else
        {
            // $user_profile = User::where('id',Auth::user()->id)->first();
            $user_profile->fname = $request->input('fname');
            $user_profile->lname = $request->input('lname');
            $user_profile->phone_no = $request->input('phone_no');
            $user_profile->update();

            return redirect()->back()->with('success','Profile has been successfully updated.');
        }
    }
    public function my_address()
    {
        $categories = Category::where('status','1')->get();
        $deliveryAdresses = Address::latest()->where('user_id',Auth::user()->id)->paginate(5);
        return view('frontend.address.index',compact('categories','deliveryAdresses'));
    }
    public function edit($id)
    {

        $categories = Category::where('status','1')->get();
        $address = Address::find($id);
        return view('frontend.address.edit',compact('categories','address'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'string', 'max:13'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'detailed_address' => ['required', 'string', 'max:255'],
        ]);
        $address = Address::find($id);
        $address->update([
            'user_id' => $request->input('user_id'),
            'email' => $request->input('email'),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone_no' => $request->phone_no,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'postal_code' => $request->postal_code,
            'detailed_address' => rtrim($request->detailed_address, ','),
        ]);
        return redirect('my-address')->with('alert','Address updated successfully');

    }
    public function deleteAddress(Request $request)
    {
        $address_id = $request->input('address_id');
        $address = Address::where('id', $address_id)->first();
        $address->delete();
        return response()->json(['status'=> 'Address deleted successfully!']);
    }
}
