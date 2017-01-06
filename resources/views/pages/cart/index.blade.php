@extends('layouts.master')

@section('title')
    Shopping Cart | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
    {{Request::url()}}
@endsection

@section('meta-title')
    Shopping Cart | Wingman Grooming
@endsection

@section('meta-description')
    Shopping Cart
@endsection

@section('meta-image')
    
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')

<input type="hidden" id="refresh" value="no">

<div class="cart-main">Your Shopping Cart</div>

<div class="mobile-only-title">
    <hr class="mobile-only">
        Shopping Cart
    <hr class="mobile-only">
</div>


<div class="cart-container">
    <div class="cart-title">Item/s</div>
    <div class="cart-title">Price</div>
    <div class="cart-title">QTY</div>
    <div class="cart-title">Total</div>
</div>

<!-- LOOP TO SHOW CART ITEMS-->

{!! Form::open([      
    'method' => 'POST',
    'action' => 'PaypalController@postPayment',
]) !!}

@if(Cart::count() != 0)

    @foreach(Cart::content() as $key => $item)
        @if(($item->name != "Discount" ) &&  ($item->name != "Shipping" ))
            <div class="cart-item-container">
                
                <div class="the-cart">
                   
                    <img src="{{$item->options->image}}" align="left" width="150px" height="150px">
                    

                    {{$item->name}}
                </div>
                
                <div class="the-cart">
                    Php {{number_format($item->price)}}
                </div>
                
                <!--DONT FORGET VALUE -->
                <div class="the-cart">
                    <input class="prh-num itemQty" id="input-qty" data-id="{{$item->rowId}}" type="number" name="qty" min = "1" max="{{$item->options->stock}}" value="{{$item->qty}}" />
                </div>
                
                <div class="the-cart">
                    Php&nbsp;<span id="total{{$key}}">{{number_format($item->total)}}</span>
                         
                    <a class="removeItem" href="" data-id="{{$item->rowId}}">
                        <div class="cart-cancel">x</div>
                    </a>
                </div>                
            </div>
        @endif
    @endforeach

@else
    <!-- IF EMPTY -->
    <div class="cart-item-container">
        
        <div class="cart-empty">
            No item inside your cart
        </div>
    </div>
    <!---end here -->

@endif
<!---end here -->
<div class="after-cart-container">
    
    <div class="voucher-container">
        <label id="v-label" class="control-label" style="display:none;" for="voucher"></label><br>

        <span id="v-help-b" style="display:none;" class="help-block"></span>
        
        <div>
            <input id="input-vouch" type="text" name="voucher" placeholder="Enter Voucher Code"/>
            <a id="btnVoucher" href="#">USE VOUCHER</a>
        </div>
    </div>

    <div class="money-container">
        <div class="subtotal-container">
            <div class="left">
                Subtotal
            </div>

            <div class="right">
                Php &nbsp;<span id="subtotal">{{Cart::subtotal()}}</span>
            </div>
        </div>

        <div class="extra-container">
            <div class="per-extra-container">
                <div class="left">
                    Discount
                </div>
                <div class="right">
                   PHP <div style="display: inline;" id="voucher-discount-value">0.00</div>
                </div>
            </div>

            <div class="per-extra-container">
                <div class="left-sec">
                    Total
                </div>
                <div class="right-sec">
                   PHP <div style="display: inline;" id="total-after-discount">{{Cart::subtotal()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cart-divider">

</div>

<div class="shipping-details">

    <h5>shipping details</h5>
    <br>
    <div class="full">
        <b>*</b><i>Free Shipping for purchases worth of </i><b><i>PHP {{$shipcost->ship_nocost}} or above</i></b>.<br>    
    </div>

    <div class="full">
        <b>*</b>Full Name
        <input id="input-detail" type="text" placeholder="Full Name" name="fullname" required />
    </div>    

    <div class="full">
        <b>*</b>Address / City / Postal Code<br>
        <input id="input-detail-address" type="text" placeholder="House No.,Floor No.,Building No.,Street,Subdivision,Brgy.,City" name="address" required/>
        <input id="input-detail-postal" type="text" placeholder="Postal ID" name="postal" required/>
    </div>

    <div class="full">
        <b>*</b>Region<br>
        <select name="region" class="input-region">
            <option value="manila">Metro Manila (PHP {{$shipcost->manila_cost}} Shipping Fee)</option>
            <option value="out-manila">Outside Metro Manila (PHP {{$shipcost->outmanila_cost}} Shipping Fee)</option>
        </select>
        
    </div>

    <div class="full">
        <b>*</b>Delivery Options<br>    
        <input type="radio" name="delivery" value="standard" checked> Standard Delivery (No Additional Cost)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="delivery" value="express"> Express Delivery (Add PHP {{$shipcost->express_shipping}})<br>
    </div>

    <div class="full">
        <b>*</b>Email / Phone Number<br>
        <input id="input-detail-email" type="text" placeholder="E-mail" name="email" required/>
        <input id="input-detail-number" type="text" placeholder="Phone Number" name="phonenumber" required/>
    </div>

    <div class="full">
        Notes / Special Instructions
        <input id="input-detail-note" type="text" name="notes" />
    </div>
    
</div>

<div class="terms">
    <input id="input-terms" type="checkbox" name="terms" value="1" required /> I agree to the <a href="{{route('policy.index')}}">terms and refund policy</a>
</div>

<div class="cart-btn-container">
    <div>
        <a href="{{route('shop.index')}}">Continue Shopping</a>
    </div>
    
    <div>
        {{-- <a href="{{URL('payment/checkout')}}">Proceed to Checkout</a> --}}
        @if(Cart::count() != 0)
            <input id="button" type="submit" value="" class="paypal"/>  
        @else
            <input id="button" type="submit" value="" class="paypal btn-disabled" disabled/>
        @endif      
    </div>
</div>

<script type="text/javascript"> 

    $(document).ready(function() {        
        
        $.ajax({
            type: "GET",
            url: '/webapi/cart/remove-discount',                
            //url: 'http://localhost:8080/wingmangrooming/public/index.php/webapi/cart/remove-discount',                
            data: {
                          
            },  
            success: function(data) {
                //console.log(data);  
                //input.val() == 'yes' ? window.location.reload(true) : input.val('yes');
            },
            error: function(xhr, status, error) {
          
            if(xhr)
            {
                // So we remove everything before the first '{
                var result = xhr.responseText.replace(/[^{]*/i,'');
                console.log(result);

                //We parse the json
                var data = JSON.parse(result);
              
                $('#errorhere').html("<div class='alert alert-danger'></div>");
                // And continue like no error ever happened
                $.each(data, function(i,item){
                        $('.alert-danger').append(item + "<br>");
                    });
                }
            } 
        });

        var input = $('#refresh');
        //input.val() == 'yes' ? window.setTimeout('location.reload(true)', 500) : input.val('yes');
        input.val() == 'yes' ? window.setTimeout(window.location.replace("{{route('shop.index')}}"), 500) : input.val('yes');
        
    });
      
    $('.removeItem').click(function()            
    {
        var id = $(this).attr("data-id");   

        console.log(id);

        $.ajax({
            type: "POST",
            url: '/webapi/cart/remove-item',                
            //url: 'http://localhost:8080/wingmangrooming/public/index.php/webapi/cart/remove-item',                
            data: {
                "id" : id,                
            },  
            success: function(data) {
                console.log(data); 
                location.reload();   
            },
            error: function(xhr, status, error) {
          
            // So we remove everything before the first '{
            var result = xhr.responseText.replace(/[^{]*/i,'');
            console.log(result);
            //We parse the json
            var data = JSON.parse(result);
          
            $('#errorhere').html("<div class='alert alert-danger'></div>");
            // And continue like no error ever happened
            $.each(data, function(i,item){
                    $('.alert-danger').append(item + "<br>");
                });
            } 
        });
    });  
    
    //update total for item
    $('.itemQty').on('focusout',function()            
    {          
        var id = $(this).attr("id");
        var rowid = $(this).attr("data-id");         
        var value = $(this).val();

        var discount = document.getElementById("voucher-discount-value").innerHTML;
        discount = discount.replace(',', '').trim();

        var val = $.trim($(".itemQty").val())

        var qtyInp = document.getElementById(id);
        
        if(val.length == 0)
        {
            qtyInp.value = 1;
        }

        if(val.length > 0)
        {
            if(!($(this).is(':focus')))
            {
                $.ajax({
                    type: "POST",
                    //url: 'http://localhost:8080/wingmangrooming/public/index.php/webapi/cart/update-item',                
                    url: '/webapi/cart/update-item',                
                    data: {
                        "id" : id,                
                        "rowid" : rowid,                
                        "value" : value,                
                    },  
                    datatype: 'json',
                    success: function(data) {
                        //console.log(data);

                        document.getElementById("total"+rowid).innerHTML = data[0][rowid]["subtotal"].toLocaleString('en-US');
                        document.getElementById("subtotal").innerHTML  = data[1];  
                        total = data[1].replace(',', '').trim();
                        active_discount_value = $.cookie('active_discount_value');                      

                        console.log(active_discount_value);
                        if(active_discount_value)
                        {    
                            //update percent type discounts
                            var discount_multiplier = active_discount_value/100;
                            var discount_value = (total*discount_multiplier).toFixed(2);
                            var newTotal = (total-discount_value).toFixed(2);

                            document.getElementById("voucher-discount-value").innerHTML  = discount_value; 
                        }
                        
                        //display updated
                        if(discount != 0.00)
                        {
                            //console.log(data[1]+' '+discount);
                            document.getElementById("total-after-discount").innerHTML  = (total-discount).toFixed(2);
                        }  
                        else
                        {
                            document.getElementById("total-after-discount").innerHTML = data[1];
                        }

                        if((data[0][rowid]["subtotal"]-discount) < 0)
                        {
                            document.getElementById("total-after-discount").innerHTML  = "0.00";
                        }                                                
                    },
                    error: function(xhr, status, error) {
                    window.setTimeout('location.reload(true)', 1000);
                    // So we remove everything before the first '{
                    var result = xhr.responseText.replace(/[^{]*/i,'');
                    console.log(result);
                    //We parse the json
                    var data = JSON.parse(result);
                  
                    $('#errorhere').html("<div class='alert alert-danger'></div>");
                    // And continue like no error ever happened
                    $.each(data, function(i,item){
                            $('.alert-danger').append(item + "<br>");
                        });
                    } 
                });
            }
        }
    });      
    
    // //update subtotal
    // $(document).on("ready",
    //     function() {
    //         setInterval(function() {
    //             $.ajax({
    //                 type: "GET",
    //                 url: 'webapi/cart/subtotal',                
    //                 success: function(data) {
    //                     //console.log(data);

    //                     document.getElementById("subtotal").innerHTML  = data;
    //                 },
    //                 error: function(xhr, status, error) {
                  
    //                 // So we remove everything before the first '{
    //                 var result = xhr.responseText.replace(/[^{]*/i,'');
    //                 console.log(result);
    //                 //We parse the json
    //                 var data = JSON.parse(result);
                  
    //                 $('#errorhere').html("<div class='alert alert-danger'></div>");
    //                 // And continue like no error ever happened
    //                 $.each(data, function(i,item){
    //                         $('.alert-danger').append(item + "<br>");
    //                     });
    //                 } 
    //             });
    //         }, 1);
    // });

    $('#btnVoucher').click(function(e)            
    {
        e.preventDefault();

        var voucher = $("#input-vouch").val();        

        $.ajax({
            type: "GET",
            url: '/webapi/cart/voucher-valid',                
            data: {
                "voucher" : voucher,                
            },  
            success: function(data) {
                var buttonVoucher = document.getElementById("btnVoucher");
                var label = document.getElementById("v-label");
                var helpBlock = document.getElementById("v-help-b");
                var inputVouch = document.getElementById("input-vouch");
                                 
                var subtotal = '{{Cart::subtotal()}}'; //but a string, so convert it to number
                subtotal = subtotal.replace(',', '').trim();

                buttonVoucher.style.display = "none";
                label.style.display = "inline-block";
                helpBlock.style.display = "inline-block";
                helpBlock.style.fontSize = "10pt";  
                inputVouch.style.marginBottom = '-5px';

                if(data['discount_type'] == "Percent")
                {
                    var discount_multiplier = data['discount_value']/100;
                    var discount_value = (subtotal*discount_multiplier).toFixed(2);
                    var newTotal = (subtotal-discount_value).toFixed(2);

                    document.getElementById("voucher-discount-value").innerHTML  = discount_value;

                    if(newTotal >= 0)
                    {
                        document.getElementById("total-after-discount").innerHTML  =  newTotal;
                    }
                    else if(newTotal < 0)
                    {
                        document.getElementById("total-after-discount").innerHTML  =  "0.00";
                    }
                    
                    $.cookie('active_discount_value', data['discount_value']);

                }
                else if(data['discount_type'] == "Amount")
                {
                    var discount_value = data['discount_value'];
                    var newTotal = (subtotal-discount_value).toFixed(2);

                    document.getElementById("voucher-discount-value").innerHTML  =  discount_value;

                    if(newTotal >= 0)
                    {
                        document.getElementById("total-after-discount").innerHTML  =  newTotal;
                    }
                    else if(newTotal < 0)
                    {
                        document.getElementById("total-after-discount").innerHTML  =  "0.00";
                    }
                }
                

                if(data.length != 0)
                {     
                    label.style.color = "#3c763d";
                    label.innerHTML= 'VOUCHER VALID!';
                    
                    helpBlock.style.color = "#3c763d";  
                    helpBlock.innerHTML = data['description'];  
            
                    $('#input-vouch').addClass( 'vouch-success' );
                    $('#input-vouch').removeClass( 'vouch-error' );
                } 
                else
                {                    
                    label.style.color = "#a94442";
                    label.innerHTML= 'INVALID VOUCHER!';

                    helpBlock.style.color = "#a94442"; 
                    helpBlock.innerHTML= "Sorry. This voucher hasn't started yet or has already expired.";
                    
                    $('#input-vouch').addClass( 'vouch-error' );
                    $('#input-vouch').removeClass( 'vouch-success' );
                }   
            },
            error: function(xhr, status, error) {
          
            // So we remove everything before the first '{
            var result = xhr.responseText.replace(/[^{]*/i,'');
            console.log(result);
            //We parse the json
            var data = JSON.parse(result);
          
            $('#errorhere').html("<div class='alert alert-danger'></div>");
            // And continue like no error ever happened
            $.each(data, function(i,item){
                    $('.alert-danger').append(item + "<br>");
                });
            } 
        });
    }); 
    
    //remove other class in voucher text box
    $("#input-vouch").on('paste input', function(){  

        var label = document.getElementById("v-label");        
        var helpBlock = document.getElementById("v-help-b");
        var inputVouch = document.getElementById("input-vouch");
        
        $(this).removeClass( 'vouch-success' );
        $(this).removeClass( 'vouch-error' ); 

        inputVouch.style.marginBottom = '10px';
        label.style.display = "none";
        helpBlock.style.display = "none";

        //clear session if anything character or word is changed
        {{Session::put('voucher-code','')}}
        {{Session::put('voucher-discount-type','')}}
        {{Session::put('voucher-discount-value','')}}
        {{Session::put('voucher-one-time','')}}
        {{Session::put('voucher-active','')}}

        $.cookie('active_discount_value','');
        document.getElementById("voucher-discount-value").innerHTML = '0.00';
        
        document.getElementById("total-after-discount").innerHTML = document.getElementById("subtotal").innerHTML;

        var buttonVoucher = document.getElementById("btnVoucher");
        buttonVoucher.style.display = "inline-block";
    });

    
</script> 

{!! Form::close() !!}

@endsection