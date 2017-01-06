@extends('layouts.master')

@section('title')
    Shipping Costs 
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Shipping Costs 
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
    <h1 class="h1-table-title"><b>Shipping Costs</b></h1>

    <div id="panel-style" class="panel panel-primary">        
        <div class="panel-body">            
            <div class="form-horizontal"> 
                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label">Metro Manila</label>    
                    <div class="shop-show-col col-sm-5">                              
                        <b>PHP {{$shipdet->manila_cost}}</b>
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label">Outside Metro Manila</label>    
                    <div class="shop-show-col col-sm-5">                              
                        <b>PHP {{$shipdet->outmanila_cost}}</b>
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label">Free Shipping</label>    
                    <div class="shop-show-col col-sm-5">                              
                        <b>Minimum purchase of PHP {{$shipdet->ship_nocost}}</b>
                    </div>       
                </div> 

                <div class="form-group">   
                    <label for="title" class="col-sm-4 control-label">Express Shipping</label>    
                    <div class="shop-show-col col-sm-5">                              
                        <b>PHP {{$shipdet->express_shipping}}</b>
                    </div>       
                </div>               
            </div>

            <a id="btnEdit" href="{{ route('shipping-cost.edit', $shipdet->shipdet_id) }}" class="btn btn-warning" role="button">
                <span id="editable" title="Edit" class="glyphicon glyphicon-edit"></span>
                <b>Edit</b>
            </a>
        </div>
    </div>
@endsection