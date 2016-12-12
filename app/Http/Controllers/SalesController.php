<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Order;

use Auth;

class SalesController extends Controller
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
        $orders = Order::where('active',1)
        			   ->where('deleted',0)
        			   ->where('order_status','Delivered')
        			   ->orderBy('created_date','DESC')
        			   ->paginate(10);

        return view('pages.sales.index',['orders' => $orders]);
    }    
   
}
