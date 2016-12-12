@extends('layouts.master')

@section('title')
    Wingman Grooming | About
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Wingman Grooming | About
@endsection

@section('meta-description')
    
@endsection

@section('meta-image')
	
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    
    <div class="about-us">  
        @if(Auth::user())       
            <div class="row">
                <div class="btn-group pull-right">
                    <table>
                        <tr>
                            <td>
                                <a id="btnEdit" href="{{ route('about.edit', $about->about_id) }}" class="btn btn-warning" role="button">
                                    <span id="editable" title="Edit" class="glyphicon glyphicon-edit"></span>
                                    <b>Edit</b>
                                </a>
                            </td>                           

                        </tr>
                    </table>
                </div>
            </div>    
        @endif 

        <h1 class="h1-table-title h1-center">About the Website</h1>

        <p>{!! $about->about_website !!} </p>        
    </div>
    
@endsection