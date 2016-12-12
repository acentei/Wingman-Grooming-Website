@extends('layouts.master')

@section('title')
    New Newsletter Type
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 New Newsletter Type
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
    
    {!! Form::open([      
        'method' => 'POST',
        'action' => 'NewsletterTypeController@store',
    ]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>New Newsletter Type</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Newsletter Type</label>    
                    <div class="col-sm-10">                              
                        <input type="text" name="name" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Save" class="btn btn-success"/>
                        <a href="{{ route('newsletter-type.index') }}" class = "btn btn-danger" > Cancel </a>  
                    </div>       
                </div>                
                
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}

@endsection