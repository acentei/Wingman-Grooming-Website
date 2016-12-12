@extends('layouts.master')

@section('title')
    Message Sent | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Message Sent | Wingman Grooming
@endsection

@section('meta-description')
    Message Sent
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
        Message Sent
    </div>
    
    <div class="response-note">
        <p>
            Thank you for getting in touch with us.<br>
            Your message has been sent.<br>
            Your message is currently being processed.
        </p>
    </div>
    
    <div class="response-img-container">
    
        <img src="https://s-media-cache-ak0.pinimg.com/originals/e5/e7/24/e5e724ae24af119df4052b59eddcc7e5.jpg">
    
    </div>

    
</div>

@endsection