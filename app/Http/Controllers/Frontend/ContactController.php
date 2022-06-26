<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contact;
use Mail;
use App\Category;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('id','>',0)->get();
        $categories = Category::where('status','1')->get();
        return view('frontend.contact-us',compact('categories','contacts'));
    }
    public function save_contact(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable',
            'phone_number' => 'nullable',
            'message' => 'required'
        ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->phone_number = $request->phone_number;
        $contact->message = $request->message;

        $contact->save();

        \Mail::send('emails.contact_email',
             array(
                 'name' => $request->get('name'),
                 'email' => $request->get('email'),
                 'subject' => $request->get('subject'),
                 'phone_number' => $request->get('phone_number'),
                 'user_message' => $request->get('message'),
             ), function($message) use ($request)
               {
                  $message->from($request->email);

                  $message->subject(ucfirst($request->subject));
                  $message->to('enterpriserealvalue@gmail.com');
               });
        return back()->with('success', 'Thank you for contact us!');

    }
}
