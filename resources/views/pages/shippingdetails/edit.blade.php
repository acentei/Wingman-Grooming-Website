@extends('layouts.master')

@section('title')
    Edit Shipping Costing 
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Edit Shipping Costing
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
    
    {!! Form::model($shipdet, [		
	    'method' => 'PUT',
        'route' => ['shipping-cost.update', $shipdet->shipdet_id],
	]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>Edit Shipping Costing</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label">Metro Manila Cost</label>    
                    <div class="col-sm-3">                              
                        <input type="number" name="manila_cost" value="{{$shipdet->manila_cost}}" class="form-control" min="0" required />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label">Outside Metro Manila Cost</label>    
                    <div class="col-sm-3">                              
                        <input type="number" name="outmanila_cost" value="{{$shipdet->outmanila_cost}}" class="form-control" min="0" required />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label">Free Shipping</label>    
                    <div class="col-sm-3">                              
                        <input type="number" name="ship_nocost" value="{{$shipdet->ship_nocost}}" class="form-control" min="0" required />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label">Express Shipping</label>    
                    <div class="col-sm-3">                              
                        <input type="number" name="express_shipping" value="{{$shipdet->express_shipping}}" class="form-control" min="0" required />
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label"></label>    
                    <div class="col-sm-6">                              
                        <input id="button" type="submit" value="Update" class="btn btn-success"/>
                        <a href="{{ route('shipping-cost.index') }}" class = "btn btn-danger" > Cancel </a>  
                    </div>       
                </div>                
                
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}

@endsection