<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Subscriber;
use App\Models\PromoCode;

use Mail;

class SubscribingController extends Controller
{
	public function subscribe()
	{
		$exist = Subscriber::where('email',\Request::get('email'))
						   ->get();

		//update
		if(count($exist) > 0)
		{
			if($exist[0]->isSubscribing == 1)
			{
				return redirect()->to('/subscribe/fail');
			}
			else
			{
				$subscriber = Subscriber::find($exist[0]->subscriber_id);

				$subscriber->isSubscribing = 1;

				$subscriber->save();
			}
		}
		//create
		else
		{
			$subscriber = new Subscriber();

			$subscriber->email = \Request::get('email');

			$subscriber->save();

			//generate subscription promo code
            $promo = new PromoCode();

            //generate a unique random code
            do
            {
                $randCode = "WINGMAN".mt_rand();

                $existOrder = PromoCode::where('code','=',$randCode)
                                   ->where('active',1)
                                   ->where('deleted',0)
                                   ->get();
            }            
            while(count($existOrder) != 0 );

            $promo->code = $randCode;            
            $promo->description = "Get PHP200 off.";
            $promo->discount_type = "Amount";
            $promo->is_one_time_use = 1;
            $promo->is_subscriber_only = 1;
            $promo->discount_value = "200";
            
            //$promo->save();

            //SEND PROMO CODE TO SUBSCRIBERS
            $data = array(
                            'code' => $randCode,
                            'description' => $promo->description,
                            'email' => \Request::get('email'),
                        );

            Mail::send('pages.emails.subscribing-voucher', $data, function($message) use ($data)
            {
                $message->subject('Wingman Grooming Subscription Promo Code');
                $message->to($data['email']);
            });
		}

		return redirect()->to('/subscribe/success');
	}
}
