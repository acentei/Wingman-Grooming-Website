<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Subscriber;

class SubscribingController extends Controller
{
	public function subscribe()
	{
		$exist = Subscriber::where('email',\Request::get('email'))
						   ->get();

		//update
		if(count($exist) > 0)
		{
			$subscriber = Subscriber::find($exist[0]->subscriber_id);

			$subscriber->isSubscribing = 1;

			$subscriber->save();
		}
		//create
		else
		{
			$subscriber = new Subscriber();

			$subscriber->email = \Request::get('email');

			$subscriber->save();
		}

		return redirect()->to('/subscribe/success');
	}
}
