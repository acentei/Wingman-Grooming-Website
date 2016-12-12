@extends('layouts.master')

@section('title')
    Wholesale Application Sent | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Wholesale Application Sent | Wingman Grooming
@endsection

@section('meta-description')
    Wholesale Application Sent
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
        Wholesale Application Sent
    </div>
    
    <div class="response-note">
        <p>
            Thank you for your time.<br>
            Your application has been sent.<br>
            Your application is currently being processed.
        </p>
    </div>
    
    <div class="response-img-container">
    
        <img src="https://s-media-cache-ak0.pinimg.com/originals/e5/e7/24/e5e724ae24af119df4052b59eddcc7e5.jpg">
    
    </div>

    
</div>

@endsection