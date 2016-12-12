@extends('layouts.master')

@section('title')
    Error 404 | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Error 404 | Wingman Grooming
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
<h1>ERROR 404</h1>
    Sorry. The Page does not exist.<br>
    <br>
    Go back to <a href="{{route('home.index')}}">Homepage</a>.
</div>

@endsection