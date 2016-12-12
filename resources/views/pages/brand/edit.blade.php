@extends('layouts.master')

@section('title')
    Edit Brand - {{$brand->display_name}}
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 Edit Brand - {{$brand->display_name}}
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
    
    {!! Form::model($brand, [		
	    'method' => 'PUT',
        'route' => ['brand.update', $brand->brand_id],
	]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>Edit Brand - {{$brand->display_name}}</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Brand Name:</label>    
                    <div class="col-sm-10">                              
                        <input type="text" name="name" value="{{$brand->display_name}}" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Update" class="btn btn-success"/>
                        <a id="btnCancel" data-href="{{ route('brand.index') }}" class="btn btn-danger"
                            class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                            data-title = "Cancel editing: '{{$brand->display_name}}'" data-message = "Your changes will not be saved. Are you sure?"
                            data-btncancel = "btn-default" data-btnaction = "btn-danger" data-btntxt = "Confirm">
                               
                            Cancel 
                        </a>  
                    </div>       
                </div>                
                
            </div>
        </div>
    </div>

    @include('modals.cancel')
    
    {!! Form::close() !!}

@endsection