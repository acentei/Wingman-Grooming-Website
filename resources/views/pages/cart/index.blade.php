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

@if(count(Cart::content()) != 0)

    @foreach(Cart::content() as $key => $item)

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
                     
                <a class="removeItem" href="1" data-id="{{$item->rowId}}">
                    <div class="cart-cancel">x</div>
                </a>
            </div>
            
        </div>

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

<div class="voucher-container">
    Vouchers <br><br>
    <label id="v-label" class="control-label" style="display:none;" for="voucher"></label>
    <input id="input-vouch" type="text" name="voucher" />
    <span id="v-help-b" style="display:none;" class="help-block"></span><br>
    <a id="btnVoucher" href="#">USE VOUCHER</a>
</div>

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
            00.00
        </div>
    </div>
    
    <div class="per-extra-container">
        <div class="left">
            Total
        </div>
        <div class="right">
            00.00
        </div>
    </div>
</div>

<div class="cart-divider">

</div>

<div class="shipping-details">

    <h5>shipping details</h5>

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
    <input id="input-terms" type="checkbox" name="terms" value="1" required /> I agree to the terms and refund policy
</div>

<div class="cart-btn-container">
    <div>
        <a href="{{route('shop.index')}}">Continue Shopping</a>
    </div>
    
    <div>
        {{-- <a href="{{URL('payment/checkout')}}">Proceed to Checkout</a> --}}
        <input id="button" type="submit" value="" class="paypal"/>        
    </div>
</div>

<script type="text/javascript"> 
      
    $('.removeItem').click(function()            
    {
        var id = $(this).attr("data-id");   

        console.log(id);

        $.ajax({
            type: "POST",
            url: 'webapi/cart/remove-item',                
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
                    url: 'webapi/cart/update-item',                
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
            url: 'webapi/cart/voucher-valid',                
            data: {
                "voucher" : voucher,                
            },  
            success: function(data) {
                console.log(data);

                var label = document.getElementById("v-label");
                var helpBlock = document.getElementById("v-help-b");
                var inputVouch = document.getElementById("input-vouch");

                label.style.display = "inline-block";
                helpBlock.style.display = "inline-block";
                helpBlock.style.fontSize = "10pt";  
                inputVouch.style.marginBottom = '-5px';

                if(data.length != 0)
                {     
                    label.style.color = "#3c763d";
                    label.innerHTML= 'VOUCHER VALID!';
                    
                    helpBlock.style.color = "#3c763d";  
                    helpBlock.innerHTML = data[0]['description'];  
            
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
    $("#input-vouch").on('change keydown paste input', function(){  

        var label = document.getElementById("v-label");        
        var helpBlock = document.getElementById("v-help-b");
        var inputVouch = document.getElementById("input-vouch");
        
        $(this).removeClass( 'vouch-success' );
        $(this).removeClass( 'vouch-error' ); 

        inputVouch.style.marginBottom = '10px';
        label.style.display = "none";
        helpBlock.style.display = "none";
    });
     
</script> 

{!! Form::close() !!}

@endsection