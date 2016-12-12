<?php

namespace App\Http\Controllers\webapi;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cart;
use App\Models\PromoCode;

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
        $promoCode = PromoCode::where('code',$request->voucher)                              
                              ->where('active',1)
                              ->where('deleted',0)
                              ->first();

        return $promoCode;
        
    }
}
