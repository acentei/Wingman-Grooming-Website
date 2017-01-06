<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\ShippingDetails;

use Auth;

class ShippingDetailsController extends Controller
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
        $shipdet = ShippingDetails::get();          
            
        return view('pages.shippingdetails.index',['shipdet' => $shipdet[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipdet = ShippingDetails::find($id); 
                
        return view('pages.shippingdetails.edit',['shipdet' => $shipdet]);
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
        $shipdet = ShippingDetails::find($id);
        
        $shipdet->manila_cost = $request->manila_cost;
        $shipdet->outmanila_cost = $request->outmanila_cost;
        $shipdet->ship_nocost = $request->ship_nocost;
        $shipdet->express_shipping = $request->express_shipping;
                
        $shipdet->save();
        
        return redirect()->route('shipping-cost.index');   
    }
}
