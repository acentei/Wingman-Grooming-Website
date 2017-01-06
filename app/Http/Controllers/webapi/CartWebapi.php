<?php

namespace App\Http\Controllers\webapi;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cart;
use App\Models\PromoCode;
use Session;

class CartWebapi extends Controller
{    
    /**
     *  
     */
    public function __construct()
    {  
        $this->dateNow = date('Y-m-d');    
    } 

	//add to session cart the item
    public function postAddCart(Request $request)
    {
        $cartItem = Cart::add($request->id, $request->name, intval($request->qty), $request->price, ['id' => $request->id,'code' => $request->code,'image' => $request->image,'stock' => $request->stock]);
		Cart::setTax($cartItem->rowId,0);

    	return Cart::content();
    }

    public function postAddCartDetails(Request $request)
    {
        $cartItem = Cart::add($request->id, $request->name, intval($request->qty), $request->price, ['id' => $request->id,'code' => $request->code,'image' => $request->image,'stock' => $request->stock]);
        Cart::setTax($cartItem->rowId,0);

        return Cart::content();
    }

    public function postRemoveItem(Request $request)
    {
        Cart::remove($request->id);

        return Cart::content();        
    }

    public function getRemoveDiscount()
    {
        $discount = Session::get('discount_rowid');
        $shipping = Session::get('shipping_id');
        
        if($discount != '')
        {  
            Cart::remove($discount); 
            Session::put('discount_rowid','');  
        }	   

        //remove shipping
        if($shipping != '')
        {
            Cart::remove($shipping); 
            Session::put('shipping_id','');
        }

        return Cart::content();    
    }

    public function postUpdateItem(Request $request)
    {
        Cart::update($request->rowid, $request->value); // Will update the quantity

        $stotal = Cart::subtotal();

        return [Cart::content(),$stotal];
    }

    public function getCartCount(Request $request)
    {
        $count = Cart::count();

        return $count;
    }

    public function getSubtotal(Request $request)
    {
        return $stotal;
    }

    public function getVoucherValid(Request $request)
    {        
        //check first durtation based promos
        $durationPromo = PromoCode::where('code',$request->voucher)    
                                  ->where('start_date','<=',date('Y-m-d'))                          
                                  ->where('expiration_date','>=',date('Y-m-d'))                          
                                  ->where('active',1)
                                  ->where('deleted',0)
                                  ->first();

        if(count($durationPromo) != 0)
        {
            Session::put('voucher-code',$durationPromo->code);
            Session::put('voucher-discount-type',$durationPromo->discount_type);            
            Session::put('voucher-discount-value',$durationPromo->discount_value);
            Session::put('voucher-one-time',$durationPromo->is_one_time_use);
            Session::put('voucher-active',1);

            return $durationPromo;
        }        
        else
        {
            $oneTime = PromoCode::where('code',$request->voucher)                              
                                ->where('is_one_time_use',1)
                                ->where('active',1)
                                ->where('deleted',0)
                                ->first();

            if(count($oneTime) != 0)
            {
                Session::put('voucher-code',$oneTime->code);
                Session::put('voucher-discount-type',$oneTime->discount_type);
                Session::put('voucher-discount-value',$oneTime->discount_value);
                Session::put('voucher-one-time',$oneTime->is_one_time_use);
                Session::put('voucher-active',1);

                return $oneTime;
            }
            else
            {
                return '';
            }
        }
    }
}
