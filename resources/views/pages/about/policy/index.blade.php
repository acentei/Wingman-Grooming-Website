@extends('layouts.master')

@section('title')
    Wingman Grooming | Policy
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Wingman Grooming | Policy
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
                                <a id="btnEdit" href="{{ route('policy.edit', $policy->about_id) }}" class="btn btn-warning" role="button">
                                    <span id="editable" title="Edit" class="glyphicon glyphicon-edit"></span>
                                    <b>Edit</b>
                                </a>
                            </td>                           

                        </tr>
                    </table>
                </div>
            </div>     
        @endif
        
        <h1 class="h1-table-title h1-center">Website Policy</h1>

        <p>{!! $policy->policy !!} </p>        
    </div>
    
@endsection