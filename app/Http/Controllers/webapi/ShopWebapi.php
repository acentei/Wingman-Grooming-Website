<?php

namespace App\Http\Controllers\webapi;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product;

class ShopWebapi extends Controller
{
    public function getCartCount(Request $request)
    {
        $count = Cart::count();

        return $count;
    }
}
