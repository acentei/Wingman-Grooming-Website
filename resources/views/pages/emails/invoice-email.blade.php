<!DOCTYPE html>
<html lang="en">

	<head>

		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

		<style>	
			body
			{
				font-family: 'Open Sans';			
			}

			.content
		    {
		        background:#fff;            
		    }

		    /* CART */
			.cart-main
			{
			    width: 100%;
			    display: block;
			    /*font-family: Open Sans;*/
			    font-size: 30pt;
			    text-align: center;
			    padding: 50px 0 10px 0;
			    margin: auto;
			}

			.cart-container
			{
			    width: 90%;
			    margin: auto;
			}

			.cart-title:first-child
			{
			    width: 50%;
			    padding-left: 5%;
			}

			.cart-title
			{
			    width: 15%;
			    font-size: 10pt;
			    font-weight: bold;
			    text-transform: uppercase;
			    border-bottom: 1px solid #999;
			    padding-bottom: 10px;
			    margin-bottom: 5px;
			    margin-right: 10px;
			    display: inline-block;
			}

			.cart-title:last-child
			{
			    margin-right: 0px;
			}

			.cart-item-container
			{
			    width: 90%;
			    height: 150px;
			    display: block;
			    border-bottom: 1px solid #999;
			    margin: 10px auto;
			}

			.the-cart:first-child
			{
			    width: 50%;
			    margin-right: 10px;
			    display: inline-flex;
			    align-items: center;
			}

			.the-cart:first-child img
			{
			    padding-right: 20px;
			    width: 100%;
			    height: auto;
			    max-width: 150px;
			}

			.the-cart
			{
			    width: 15%;
			    height: 100%;
			    margin-right: 12px;
			    display: inline-flex;
			    align-items: center;
			    vertical-align: middle;
			}

			.the-cart:last-child
			{
			    position: relative;
			    margin-right: 0;
			}

			.cart-cancel
			{
			    position:absolute;
			    top:0;
			    right: 5%;
			    width: 15%;
			    border-radius: 80px;
			    padding-bottom: 2px;
			    border: 1px solid #000;
			    text-align: center;
			    font-size: 11pt;
			    color: #000;
			}

			.cart-empty
			{
			    width: 100%;
			    margin: auto;
			    text-align: center;
			    text-transform: uppercase;
			}

			#input-qty
			{
			    width: 35%;
			    padding-left: 5px;
			    border: 1px solid #000;
			    text-align: left;
			}

			.voucher-container
			{
			    width: 90%;
			    text-align: left;
			    text-transform: uppercase;
			    margin: 30px auto;
			}

			.voucher-container a
			{
			    text-decoration: none;
			    color:#fff;
			    background: #000;
			    padding: 10px;
			    font-size: 10pt;
			}


			.voucher-container a:hover
			{
			    text-decoration: none;
			    color:#fff;
			    background: #323232;
			    padding: 10px;
			    font-size: 10pt;
			}

			#input-vouch
			{
			    border: 1px solid #999;
			    padding: 2px;
			    margin: 10px 0;
			    width: 50%;
			    display: block;
			}

			.subtotal-container
			{
			    min-width: 30%;
			    height: 60px;
			    border: 1px solid #999;
			    float: right;
			    margin-top: 10px;
			    display: block;
			    margin-right: 5%;
			    font-size: 10pt;
			    color: #000;
			}

			.subtotal-container > .left
			{
			    height:59px;
			    min-width: 30%;
			    float:left;
			    line-height:60px;
			    text-align: center;
			    text-transform: uppercase;
			    border-right: 1px solid #999;
			    
			}
			.subtotal-container > .right
			{
			    width:auto;
			    overflow:hidden;
			    height:59px;
			    line-height: 60px;
			    text-align: center;
			    text-transform: uppercase;
			}

			.extra-container
			{
			    display: block;
			    clear:both;
			    min-width: 30%;
			    height: 60px;
			    border: 1px solid #999;
			    border-top: none;
			    float: right;
			    margin-right: 5%;
			    font-size: 10pt;
			    color: #000; 
			}

			.per-extra-container
			{
			    width: 100%;
			    display:block;
			    height: 30px;
			}

			.per-extra-container:first-child
			{
			    border-bottom: 1px solid #999;
			}

			.per-extra-container > .left
			{
			    height: 30px;
			    text-transform: uppercase;
			    min-width: 30%;
			    float:left;
			    border-right: 1px solid #999;
			    text-align: center;
			    line-height: 30px;
			}

			.per-extra-container > .right
			{
			    width: 70%;
			    overflow: hidden;
			    height: 30px;
			    float:right;
			    text-transform: uppercase;
			    text-align: center;
			    line-height: 30px;
			}

			.cart-divider
			{
			    clear: both;
			    display: block;
			    width: 105%;
			    border-bottom: 1px solid #ccc;
			    padding: 15px 10px;
			    margin-bottom: 45px;
			    margin-left: -2%;
			}

			.shipping-details
			{
			    
			    width: 50%;
			    margin: auto;
			}

			.shipping-details > h5
			{
			    text-transform: uppercase;
			    text-align: center;
			}

			.shipping-details > .full
			{
			    width:100%;
			    font-size: 10pt;
			    padding-bottom: 15px;
			}

			.shipping-details > .full > b
			{
			    color:#ff0000;
			    font-weight: normal;
			}

			#input-detail
			{
			    width: 100%;
			    display: block;
			    padding-left: 5px;
			}

			#input-detail-address
			{
			    width:80%;
			    display: inline-block;
			    padding-left: 5px;
			    margin-right: 6px;
			}

			#input-detail-postal
			{
			    width:18%;
			    display: inline-block;
			    padding-left: 5px;
			}

			#input-detail-email
			{
			    width:60%;
			    display: inline-block;
			    padding-left: 5px;
			    margin-right: 6px;
			}

			#input-detail-number
			{
			    width:38%;
			    display: inline-block;
			    padding-left: 5px;
			}

			#input-detail-note
			{
			    width: 100%;
			    height: 80px;
			    padding: 0 0 4em 5px;
			}

			.terms
			{
			    padding-top: 20px;
			    padding-bottom: 20px;
			    clear: both;
			    display: block;
			    width: 90%;
			    margin: auto;
			    text-align: right;
			    text-transform: uppercase;
			    font-size: 9pt;
			    letter-spacing: -0.5px;
			}

			#input-terms
			{
			    border: 1px solid #000;
			    margin: auto;
			}

			.cart-btn-container
			{
			    width: 90%;
			    margin: 0 auto 10px auto;
			    clear: both;
			    display: block;
			    padding-bottom: 150px;
			}

			.cart-btn-container div
			{
			    width: 49.7%;
			    display: inline-block;
			    font-size: 10pt;
			}

			.cart-btn-container div:last-child
			{
			    text-align: right;
			}

			.cart-btn-container div a
			{
			    background: #232323;
			    color:#fff;
			    padding: 5px 10px;
			    text-transform: uppercase;
			    text-decoration: none;
			    letter-spacing: 0.5px;
			}

			.cart-btn-container div a:hover
			{
			    background: #333;
			    color:#fff;
			    padding: 5px 10px;
			    text-transform: uppercase;
			    text-decoration: none;
			}

			.paypal
			{
			    background:url('../images/Paypal.png') no-repeat;
			    width: 238px;
			    height: 60px;
			    border: none;
			    box-shadow: none;
			}

			/* ---END OF CART--- */

		    .response-container
			{
			    background:#f5f5f5;
			    width: 90%;
			    margin: 30px auto;
			    padding: 30px;
			    border: 2px solid #ddd;
			}

			.response-title
			{
			    width: 100%;
			    display: block;
			    /*font-family: BebasNeue;*/
			    font-size: 35pt;
			    color:#000;
			    text-align: center;
			    margin: auto;
			}

			.response-title-sub
			{
			    color: #bb2229;
			    text-transform: uppercase;
			    text-align: center;
			    /*font-family: Gotham;*/
			    font-weight: bold;
			    font-size: 10pt;
			    letter-spacing: 2px;
			}

			.response-note, .response-receipt-note
			{
			    width: 80%;
			    display:block;
			    margin: 30px auto;
			}

			.response-note p
			{
			    background-color: #ebebeb;
			    margin: auto;
			    padding: 25px 110px;
			    font-size: 10pt;
			    line-height: 26px;
			    text-align: center;
			    /*font-family: Gotham;*/
			}

			.response-img-container
			{
			    background:#fff;
			    width: 60%;
			    text-align: center;
			    margin: auto;
			    overflow: hidden;
			}

			.response-img-container img
			{
			    width: 100%;
			    height: auto;
			    margin: auto;
			}

			/* RECEIPT - EMAIL */
			.response-receipt-note p
			{
			    background-color: #ebebeb;
			    margin: auto;
			    padding: 25px 50px;
			    font-size: 10pt;
			    line-height: 16px;
			    text-align: center; 
			    /*font-family: Gotham;*/
			}

			.response-receipt-content
			{
			    background:#494949;
			    width: 100%;
			    display: block;
			    color:#fff;
			    padding: 10px 0;
			}

			.response-receipt-content > .cart-container > .cart-title, .the-cart, .the-cart:first-child
			{
			    margin-right: 0;
			}

			.response-receipt-content > .cart-container > .cart-title,.the-cart
			{
			    width: 17%;
			}

			.response-receipt-content > .cart-container > .cart-title:first-child 
			{
			    width: 45%;
			}

			.response-receipt-content > .cart-item-container
			{
			    height: 30px;
			    vertical-align: top;
			    border: none;
			}


			.receipt-bottom
			{
			    border-top: 1px solid #999;
			    width: 90%;
			    margin: 30px auto auto auto;
			    text-align: center;
			    display: flex;
			    padding: 15px 0;
			}

			.receipt-voucher-container
			{
			    width: 48%;
			    height:60px;
			    text-align: left;
			    text-transform: uppercase;
			    display: inline-block;
			    margin:auto;
			    align-content: center;
			}

			.display-voucher
			{
			    background: #000;
			    height: 30px;
			    text-align: left;
			    padding-top: 3px;
			    padding-left: 3px;
			    margin-top: 7px;
			}

			.receipt-subtotal-container
			{
			    width: 48%;
			    height: 60px;
			    /*border: 1px solid #999;*/
			    display: inline-block;
			    margin: auto;
			    font-size: 10pt;
			    color: #000;
			    align-content: center;
			}

			.receipt-subtotal-container > .left
			{
			    background: #a4a4a4;
			    height:59px;
			    min-width: 30%;
			    float:left;
			    line-height:60px;
			    text-align: center;
			    text-transform: uppercase;
			    border-right: 1px solid #999;
			    
			}
			.receipt-subtotal-container > .right
			{
			    background: #d2d2d2;
			    width:auto;
			    overflow:hidden;
			    height:59px;
			    line-height: 60px;
			    text-align: center;
			    text-transform: uppercase;
			}

			.response-receipt-img-container
			{
			    background: #fff;
			    width: 400px;
			    height: 400px;
			    overflow: hidden;
			    margin: 50px auto;
			}

			.response-receipt-img-container img
			{
			    width: 400px;
			    height: auto;
			}

			.info-title
			{
				padding-left: 5%;
			    padding-top: 10px;
			    font-weight: bold;
			    font-size: 15px;
			}

			.receipt-details
			{
				padding-left: 5%;
				padding-bottom: 20px;
			}

			.receipt-details > b
			{
				font-size: 13px;
				text-decoration: none;
				color: #fff;
			}

		</style>

		
	</head>

	<body>	
		<div class="content">	
			<div class="response-container">

			    <div class="response-title">
			        <img src="{{ URL::asset('/images/wg-logo.png') }}" width="100px" height="auto" alt="Wingman Grooming Logo">
			    </div>

			    <div class="response-title-sub">
			        Sales Invoice Receipt
			    </div>
			    
			    <div class="response-receipt-note">
			        <p>			            
			            <i>This email message is a copy of a receipt from a recent purchase from your website.</i>
			        </p>
			    </div>
			    
			    <div class="response-receipt-content">
			    	<div class="info-title">CUSTOMER INFORMATION</div>
			    	<hr width="90%" style="margin-bottom:20px;">
			    	<div class="receipt-details">
			    		<b>ORDER CODE </b><br>&nbsb;&nbsb;&nbsb;{{$code}}</span><br><br>
				    	<b>NAME </b><br>&nbsb;&nbsb;&nbsb;{{$name}}<br><br>
				    	<b>E-MAIL </b><br>&nbsb;&nbsb;&nbsb; <span style="text-decoration: none;color: #fff;">{{$email}}</span><br><br>
				    	<b>TIMESTAMP </b><br>&nbsb;&nbsb;&nbsb;{{$date}}<br><br>
				    	<b>NOTES/SPECIAL INSTRUCTIONS </b><br>&nbsb;&nbsb;&nbsb;{{$notes}}<br><br>

			    	</div>

			    	
			    	<div class="info-title">ORDER DETAILS</div>
			    	<hr width="90%" style="margin-bottom:20px;">
			        <div class="cart-container">
			            <div class="cart-title">Item/s</div>
			            <div class="cart-title">Price</div>
			            <div class="cart-title">QTY</div>
			            <div class="cart-title">Total</div>
			        </div>
			        
			        @foreach($items as $key => $item)

				        <div class="cart-item-container">				            
				            <div class="the-cart">				               				            				                
				                {{$item['name']}}
				            </div>
				            
				            <div class="the-cart">
				                Php {{number_format($item['price'])}}
				            </div>
				            
				            <!--DONT FORGET VALUE -->
				            <div class="the-cart">
				                {{$item['quantity']}}
				            </div>
				            
				            <div class="the-cart">
				                {{number_format($item['total'])}}				                 
				            </div>
				            
				        </div>

				    @endforeach 

			        <div class="receipt-bottom">
			            <div class="receipt-voucher-container">
			                <b>Voucher Used</b>
			                <div class="display-voucher">
			                	{{$voucher}}
			                </div>
			            </div>

			            <div class="receipt-subtotal-container">
			                <div class="left">
			                    Subtotal
			                </div>

			                <div class="right">
			                    <b>Php {{number_format($totalPrice)}}</b>
			                </div>       
			            </div>
			        </div>
			    </div>		

			    <div class="response-receipt-note">
			        <p>
			            © COPYRIGHT 2016 Wingman Mercatura, Inc. All rights reserved.			            
			        </p>
			    </div>

			    
			</div>
		</div>

	</body>

</html>