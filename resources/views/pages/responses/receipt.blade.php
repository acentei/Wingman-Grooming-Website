@extends('layouts.master')

@section('title')
    Wingman Grooming Newsletter | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Wingman Grooming Newsletter | Wingman Grooming
@endsection

@section('meta-description')
   Wingman Grooming Newsletter
@endsection

@section('meta-image')
	
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

<style>
    .content
    {
        background:#fff;
    }
</style>

@endsection

@section('scripts')

@endsection

@section('content')

<div class="response-container">
    <div class="response-title">
        Wingman Grooming
    </div>
    
    <div class="response-receipt-note">
        <p>
            Your recent purchase at Wingman Grooming has been processsed and (INSERT PRICE) has been debited from your Paypal Account.
            <br><br>
            This email message will serve as your receipt.
        </p>
    </div>
    
    <div class="response-receipt-content">
        <div class="cart-container">
            <div class="cart-title">Item/s</div>
            <div class="cart-title">Price</div>
            <div class="cart-title">QTY</div>
            <div class="cart-title">Total</div>
        </div>
        
        <div class="cart-item-container">
            
            <div class="the-cart">
                Water Based Pomade
            </div>
            
            <div class="the-cart">
                Php 18.00
            </div>
            
            <div class="the-cart">
                2
            </div>
            
            <div class="the-cart">
                Php 18.00   
            </div>
        </div>
        
        <div class="receipt-bottom">
            <div class="receipt-voucher-container">
                Voucher Used
                <div class="display-voucher">
                CODE HERE CODE HERE
                </div>
            </div>

            <div class="receipt-subtotal-container">
                <div class="left">
                    Subtotal
                </div>

                <div class="right">
                    Php 54.00
                </div>       
            </div>
        </div>
    </div>
    
    <div class="response-receipt-img-container">
    
        <img src="http://www.hersheys.com/assets/images/kisses/products/cookies_creme.png">
    
    </div>

    
</div>

@endsection