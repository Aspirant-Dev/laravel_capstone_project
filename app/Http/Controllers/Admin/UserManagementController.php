<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuccessMail;

use App\Admin;
use App\User;
class UserManagementController extends Controller
{
    // code
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    public function index()
    {
        $admins = Admin::where('user_type','!=','Admin')->get();
        return view('admin.pages.usermanagement')->with('admins',$admins);
    }
    public function add()
    {
        if(Auth::user()->user_type == 'Admin')
        {
            return view('admin.pages.user management.add');
        }
        else
        {
            return redirect()->back()->with('info','You are not allowed to access this.');
        }
    }
    public function insert(Request $request)
    {
            $this->validate($request, [
                'full_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users','unique:admins'],
                'username' => ['required', 'string', 'max:255','unique:users','unique:admins'],
                'pw' => ['required', 'string', 'min:8'],

                'address' => ['required', 'string', 'max:255'],
                'phone_no' => ['required', 'string', 'max:13'],
                'status' => ['required', 'string', 'max:255'],
                'user_type' => ['required', 'string', 'max:255'],
            ]);

            $a = new Admin();
            $a->full_name = $request->full_name;
            $a->email = $request->email;
            $a->username = $request->username;
            $a->password = Hash::make($request->pw);
            $a->address = $request->address;
            $a->contact = $request->phone_no;
            $a->status = $request->status;
            $a->user_type = $request->user_type;
            $a->save();

            $email = $request->get('email');

            $data = ([
                'name' => $request->get('full_name'),
                'username' => $request->get('username'),
                'password' => $request->get('pw'),
                ]);

            Mail::to($email)->send(new SuccessMail($data));

            return redirect('/admin/user-management')->with('alert', 'User Account Added Successfully');

    }
    public function edit($id)
    {
        if(Auth::user()->user_type == 'Admin')
        {
            $admin = Admin::find($id);
            return view('admin.pages.user management.edit',compact('admin'));
        }
        else
        {
            return redirect()->back()->with('info','You are not allowed to access this.');
        }

    }
    public function update(Request $request, $id)
    {
        $a = Admin::find($id);

        $a->full_name = $request->input('full_name');
        $a->email = $request->input('email');
        $a->username = $request->input('username');
        $a->address = $request->input('address');
        $a->contact = $request->input('phone_no');
        $a->status = $request->input('status');
        $a->user_type = $request->input('user_type');

        $a->update();

        return redirect('/admin/user-management')->with('alert', 'User Account Updated Successfully');
    }
    public function delete(Request $request)
    {
        if(Auth::user()->user_type == 'Admin')
        {
            $id = $request->input('id');
            $a = Admin::where('id',$id)->first();
            $a->delete();
            return response()->json(['status' => 'User account has been deleted!','icon'=>'success']);
        }
        else
        {
            return response()->json(['status' => 'You do not have access to delete an account','icon'=>'error']);
        }
    }
}
