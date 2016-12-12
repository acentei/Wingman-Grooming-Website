<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {                    
        return view('pages.contactus.index');
    }

    public function store(Request $request)
    {                  
        $data = array(
        				'fullname' => $request->fullname,
        				'sender' => $request->email,
        				'subject' => $request->subject,
        				'content' => $request->comments,
        			 );

        Mail::send('pages.emails.inquiry-email', $data, function($message) use ($data)
        {
        	$message->subject($data['subject']);
            $message->from($data['sender'], $data['fullname']);
            $message->to('ecommerce.mark8@gmail.com');
        });

        return redirect()->to('/inquiry/sent');
    }
}
