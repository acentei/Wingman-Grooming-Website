<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Omnipay\Omnipay;
use Session;
use Cart;
use Mail;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderInfo;
use App\Models\Product;
use App\Models\ShippingDetails;

class PaypalController extends Controller
{
    public function postPayment()
    {
        $discountTotal = 0;
        $discountMultiplier = 0;
        $finalTotal = 0;        

        $order = \Request::all();

        $shipcost = ShippingDetails::get();          

        if(str_replace(",", "", Cart::total()) < $shipcost[0]->ship_nocost)
        {
            $shipTotal = 0;

            if($order['delivery'] == "express")
            {
                $shipTotal = $shipTotal + $shipcost[0]->express_shipping;
            }

            //add shipping cost depending on the region
            if($order['region'] == "manila")
            {
                $shipTotal = $shipTotal + $shipcost[0]->manila_cost;

                $cartItem = Cart::add('ship00001', 'Shipping', 1, $shipTotal);
                Cart::setTax($cartItem->rowId,0);

                Session::put('shipping_id',$cartItem->rowId);

                //$finalTotal = $total + 100;
            }
            else if ($order['region'] == "out-manila") 
            {
                $shipTotal = $shipTotal + $shipcost[0]->outmanila_cost;
                
                $cartItem = Cart::add('ship00002', 'Shipping', 1, $shipTotal);
                Cart::setTax($cartItem->rowId,0);

                Session::put('shipping_id',$cartItem->rowId);

                //$finalTotal = $total + 200;
            }            
        }
        else
        {
            $cartItem = Cart::add('ship00000', 'Shipping', 1, 0);
            Cart::setTax($cartItem->rowId,0);

            Session::put('shipping_id',$cartItem->rowId);
        }

        $total = str_replace(",", "", Cart::total());
        

        //get data if there is discount active
        if(Session::get('voucher-active') == 1)
        {
            if(Session::get('voucher-discount-type') == "Percent")
            {
                $discountMultiplier = Session::get('voucher-discount-value')/100;
                $discountTotal = 0 - ($total*$discountMultiplier);
                $finalTotal = $total + $discountTotal;

                $existDiscount = Cart::search(function($key, $value) { return $key->name == 'Discount'; });
                
                if(count($existDiscount) == 0)
                {
                    $cartItem = Cart::add(Session::get('voucher-code'), 'Discount', 1, $discountTotal);
                    Cart::setTax($cartItem->rowId,0);    

                    Session::put('discount_rowid',$cartItem->rowId);
                }  
            }
            else if(Session::get('voucher-discount-type') == "Amount")
            {
                $discountTotal = 0 - Session::get('voucher-discount-value');
                $finalTotal = $total + $discountTotal;

                $existDiscount = Cart::search(function($key, $value) { return $key->name == 'Discount'; });
                
                if(count($existDiscount) == 0)
                {
                    $cartItem = Cart::add(Session::get('voucher-code'), 'Discount', 1, $discountTotal);
                    Cart::setTax($cartItem->rowId,0);    

                    Session::put('discount_rowid',$cartItem->rowId);
                }    
            }
        }
        else
        {
            $finalTotal = $total;
        }

        $items = array();

        foreach(Cart::content() as $item)
        {
            $items[] = array('name' => $item->name, 'quantity' => $item->qty, 'price' => $item->price,'options'=> $item->options);
        }

        $params = array(
            'cancelUrl'=>'http://www.wingmangrooming.com/payment/cancel_order',
            'returnUrl'=>'http://www.wingmangrooming.com/payment/payment_success',
            //'cancelUrl'=>'http://localhost:8080/wingmangrooming/public/index.php/payment/cancel_order',
            //'returnUrl'=>'http://localhost:8080/wingmangrooming/public/index.php/payment/payment_success',
            'noshipping' => '1',
            'amount' =>  $finalTotal,
            'currency' => 'PHP'
        );

        Session::put('params', $params);
        Session::put('order', $order);
        Session::put('items', $items);
        Session::save();

        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('marks-facilitator-1_api2.fandomcafe.com');
        $gateway->setPassword('TXUPJYPESQNCCHCL');
        $gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31A3ISHtVQUf8ELb7HWVzMRJOZFRF5');
        $gateway->setTestMode(true);

        $response = $gateway->purchase($params)->setItems($items)->send();

        if ($response->isSuccessful()) {

            // payment was successful: update database
            print_r($response);
        } elseif ($response->isRedirect()) {

            // redirect to offsite payment gateway
            $response->redirect();
        } else {
            // payment failed: display message to customer
            echo $response->getMessage();
        }
    }

    /**
     * Fonction permettant de completer la requête de paiement, ainsi que de traiter la réponse de PayPal.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getSuccessPayment()
    {
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('marks-facilitator-1_api2.fandomcafe.com');
        $gateway->setPassword('TXUPJYPESQNCCHCL');
        $gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31A3ISHtVQUf8ELb7HWVzMRJOZFRF5');
        $gateway->setTestMode(true);

        $params = Session::get('params');
        $orderParams = Session::get('order');
        $itemParams = Session::get('items');

        $response = $gateway->completePurchase($params)->send();
        $paypalResponse = $response->getData(); // this is the raw response object

        if(isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
            //return $params;
            
            //generate a unique order code
            do
            {
                $randCode = date('dmy').mt_rand();

                $existOrder = Order::where('order_code','=',$randCode)
                                   ->where('active',1)
                                   ->where('deleted',0)
                                   ->get();
            }            
            while(count($existOrder) != 0 );

            // create order to be stored            
            $order = new Order();

            $order->order_code = $randCode;
            $order->order_status = "Pending";
            $order->customer_full_name = $orderParams['fullname'];
            $order->customer_email = $orderParams['email'];
            $order->customer_address =$orderParams['address'];
            $order->customer_postal = $orderParams['postal'];
            $order->customer_phone = $orderParams['phonenumber'];

            $order->save();    

            //---- create order infos ----//
            //---- voucher and notes ----//
            if($orderParams['voucher'])
            {
                $info = new OrderInfo();

                $info->order_id = $order->order_id;
                $info->name = "Voucher";
                $info->value = $orderParams['voucher'];

                $info->save();
            }

            if($orderParams['notes'])
            {
                $info = new OrderInfo();

                $info->order_id = $order->order_id;
                $info->name = "Notes";
                $info->value = $orderParams['notes'];

                $info->save();
            }

            //---- create order details (Product) ----//
            foreach ($itemParams as $key => $item) {

                if($itemParams[$key]['name'] != 'Discount')
                {
                    $orderDetail = new OrderDetail();

                    $orderDetail->order_id = $order->order_id;
                    $orderDetail->product_id = $itemParams[$key]['options']->id;
                    $orderDetail->quantity = $itemParams[$key]['quantity'];
                    $orderDetail->total = $itemParams[$key]['price'];               

                    $orderDetail->save();

                    //update stock
                    $updateStock = Product::find($itemParams[$key]['options']->id);
                    $updateStock->decrement('stocks',$itemParams[$key]['quantity']);

                    if(Session::get('voucher-one-time') == 1)
                    {
                        $updateStock->is_one_time_use = 0;
                        $updateStock->active = 0;
                    }

                    $updateStock->save();
                }
            }   

            //SEND E-RECEIPT TO EMAIL
            $data = array(
                            'totalPrice' => $params['amount'],
                            'items' => $itemParams,
                            'name' => $orderParams['fullname'],
                            'email' => $orderParams['email'],
                            'date' => date("D M j,Y h:i:sa T"),
                            'code' => $randCode,
                            'voucher' => '',
                            'notes' => '',
                    );

            if($orderParams['notes'])
            {
                $data['notes'] = $orderParams['notes'];
            }

            if($orderParams['voucher'])
            {
                $data['voucher'] = $orderParams['voucher'];
            }

            Mail::send('pages.emails.receipt-email', $data, function($message) use ($data)
            {
                $message->subject('Wingman Grooming E-Receipt');
                $message->from('ecommerce.mark8@gmail.com', 'Wingman Grooming');
                $message->to($data['email']);
            });

            Mail::send('pages.emails.invoice-email', $data, function($message) use ($data)
            {
                $message->subject('Wingman Grooming Sales Invoice');
                $message->from('ecommerce.mark8@gmail.com', 'Wingman Grooming');
                $message->to($data['email']);
            });            

            Cart::destroy();

            Session::put('discount_rowid','');
            Session::put('voucher-code','');
            Session::put('voucher-discount-type','');
            Session::put('voucher-discount-value','');
            Session::put('voucher-one-time','');
            Session::put('voucher-active','');

            return redirect()->to('/order/success');

        } else {

            //Failed transaction

        }
    }
}
