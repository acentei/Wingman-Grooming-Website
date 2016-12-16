@extends('layouts.master')

@section('title')
    Contact Us | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Wholesale | Wingman Grooming
@endsection

@section('meta-description')
    Store
@endsection

@section('meta-image')
	
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')

    <div class="mobile-only-title">
        <hr class="mobile-only">
            Wholesale
        <hr class="mobile-only">
    </div>

<div class="contact-title">
        Wholesale inquiry
</div>

    <div class="quotes"> 
        <div class="contact-note">
            <p>
                Thank you for your interest in our products! <br> Please complete the form below before we follow up with the Price List.
            </p>
        </div>    
    </div>

    {!! Form::open([      
        'method' => 'POST',
        'action' => 'WholesaleController@store',
    ]) !!}

    <div class="contact-details">
        <h4>Wholesale Application</h4>
        
        <div class="full">
        *Full Legal Title and Trading Name
            <input type="text" name="legaltitle" required/>
        </div>

        <div class="full">
        *Full Name
            <input type="text" name="fullname" required/>
        </div>
        
        <div class="full">
        *Online Reference <div class="sub-title">(Website/Instagram/Facebook Page Address)</div>
            <input type="text" name="reference" required/>
        </div>

        <div class="full">
        *Email Address
            <input type="text" name="email" required/>
        </div>

        <div class="full">
        *Registered Business Address            
            <textarea name="busadd" style="resize:none;" rows="3" required ></textarea>
        </div>

        <div class="full">
            <input id="submit" type="submit" value="Submit"/>
        </div>
    </div>

    {!! Form::close() !!}
<br>


@endsection