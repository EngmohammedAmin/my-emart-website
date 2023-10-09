<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\SetEmailData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function __construct()
    {
        if (!isset($_COOKIE['section_id']) && !isset($_COOKIE['address_name'])) {
            \Redirect::to('set-location')->send();
        }
    }

    function index()
    {
        return view('send_email');
    }

    function send(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data = array(
            'name' => $request->name,
            'message' => $request->message
        );

        Mail::to(env('MAIL_TO_ADDRESS'))->send(new SendMail($data, $request->email));

        return back()->with('success_contact', 'Thanks for contacting us!');
    }

    function sendMail(Request $request)
    {

        $data = $request->all();

        $subject = $data['subject'];
        $message = $data['message'];
        $recipients = $data['recipients'];


        Mail::to($recipients)->send(new SetEmailData($subject, $message));

        return "email sent successfully!";
    }
}

?>