<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\PromoCode;

use Auth;
use Mail;

use App\Models\Subscriber;

class PromoCodeController extends Controller
{
    /**
     *  Authenticate access
     */
    public function __construct()
    {          
        $this->middleware('auth');      
        
        if (Auth::check()){
            parent::__construct();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo = PromoCode::where('active',1)
                          ->where('deleted',0) 
                          ->get();
        
        return view('pages.promocode.index',['promo' => $promo]);
                        
    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.promocode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promo = new PromoCode();
                
        $promo->code = $request->code;
        $promo->description = $request->description;
        $promo->discount_type = $request->discount_type;

        if($request->discount_type == "Percent")
        {
            $promo->discount_value = $request->discount_percent;
        }
        elseif($request->discount_type == "Amount")
        {
            $promo->discount_value = $request->discount_amt;
        }

        if($request->oneTimeUse == 0)
        {
            $promo->is_one_time_use = 0;
        }
        else
        {
            $promo->is_one_time_use = $request->oneTimeUse;
        }

        if($request->is_subscriber_only == 0)
        {
            $promo->is_subscriber_only = 0;
        }
        else
        {
            $promo->is_subscriber_only = $request->subscOnly;
        }       
                
        $promo->start_date = date("Y-m-d", strtotime($request->start_date));
        $promo->expiration_date = date("Y-m-d", strtotime($request->expiration_date));
                
        $promo->save();

        //SEND PROMO CODE TO SUBSCRIBERS
        $data = array(
                        'code' => $request->code,
                        'description' => $request->description,
                        'email' => '',
                    );

        $emails = Subscriber::where('isSubscribing',1)
                            ->lists("email");

        foreach ($emails as $email) 
        {
            $data['email'] = $email;

            Mail::send('pages.emails.voucher-email', $data, function($message) use ($data)
            {
                $message->subject('Wingman Grooming Promo Code');
                $message->from('ecommerce.mark8@gmail.com', 'Wingman Grooming');
                $message->to($data['email']);
            });
        }

        return redirect()->route('promo-codes.index');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promo = PromoCode::find($id);
        
        return view('pages.promocode.edit',['promo' => $promo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promo = PromoCode::find($id);
        
        $promo->code = $request->code;
        $promo->description = $request->description;
        $promo->discount_type = $request->discount_type;

        if($request->discount_type == "Percent")
        {
            $promo->discount_value = $request->discount_percent;
        }
        elseif($request->discount_type == "Amount")
        {
            $promo->discount_value = $request->discount_amt;
        }

        if($request->oneTimeUse == 0)
        {
            $promo->is_one_time_use = 0;
        }
        else
        {
            $promo->is_one_time_use = $request->oneTimeUse;
        }

        if($request->is_subscriber_only == 0)
        {
            $promo->is_subscriber_only = 0;
        }
        else
        {
            $promo->is_subscriber_only = $request->subscOnly;
        }        
    
        $promo->start_date = date("Y-m-d", strtotime($request->start_date));
        $promo->expiration_date = date("Y-m-d", strtotime($request->expiration_date));
                
        $promo->save();
        
        return redirect()->route('promo-codes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = PromoCode::find($id);
        
        $promo->deleted = 1;
        $promo->active = 0;
                
        $promo->save();
        
        return redirect()->route('promo-codes.index'); 
    }
}
