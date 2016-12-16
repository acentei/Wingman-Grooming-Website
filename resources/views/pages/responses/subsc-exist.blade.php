@extends('layouts.master')

@section('title')
    Already Subscribing | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Already Subscribing | Wingman Grooming
@endsection

@section('meta-description')
    Already part of the mailing list.
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
            SUBSCRIBING
        </div>
        
        <div class="response-note">
            <p>
                You are already included in our mailing list.<br>                
            </p>
        </div>
        
    </div>

@endsection