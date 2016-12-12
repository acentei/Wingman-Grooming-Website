@extends('layouts.master')

@section('title')
    Update Stock - {{$product->name}}
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Update Stock - {{$product->name}}
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
    
    {!! Form::model($product, [		
	    'method' => 'PUT',
        'route' => ['inventory.update', $product->product_id],
	]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>Update Stock - {{$product->name}}</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Stock:</label>    
                    <div class="col-sm-3">                              
                        <input type="number" name="stock" value="{{$product->stocks}}" class="form-control" min="0" required />
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Update" class="btn btn-success"/>
                        <a id="btnCancel" data-href="{{ route('inventory.index') }}" class="btn btn-danger"
                            class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                            data-title = "Cancel updating stock for '{{$product->name}}'" data-message = "Your changes will not be saved. Are you sure?"
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