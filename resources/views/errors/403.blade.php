@extends('layouts.master')

@section('title')
    Error 403 | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Error 403 | Wingman Grooming
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

<div class="error">
<h1>ERROR 403</h1>
    Access Denied.<br>
    <br>
    Go to <a href="{{route('home.index')}}">HOME</a>
</div>

@endsection