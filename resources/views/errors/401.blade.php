@extends('layouts.master')

@section('title')
    Error 401 | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Error 401 | Wingman Grooming
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
<h1>ERROR 401</h1>
    Unauthorized: Access is denied!<br>
    <br>
    Go to <a href="{{route('home.index')}}">Homepage</a>.
</div>

@endsection