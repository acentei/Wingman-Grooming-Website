@extends('layouts.master')

@section('title')
    Payment Successful | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Payment Successful | Wingman Grooming
@endsection

@section('meta-description')
    Payment
@endsection

@section('meta-image')
	
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')

<div class="contact-title">
   Payment Successful
</div>

<div class="mobile-only-title">
    <hr class="mobile-only">
        Payment Successful
    <hr class="mobile-only">
</div>

    <div class="quotes"> 
        <div class="contact-note payment-note">
            <p>
                Thank you for shopping with us.<br>
                Your transaction was successful, payment was recieved.<br>
                Your order is currently being processed.
            </p>
        </div>    
    </div>

<div class="payment-successful">

    <!--- Randomsize in Gallery -->
    <img src="http://placehold.it/800x800">
        
        <div>
            Thank you
        </div>
    
</div>


<br>


@endsection