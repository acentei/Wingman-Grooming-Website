@extends('layouts.master')

@section('title')
    Edit Order {{$order->status}}'s Delivery Status
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 Edit Order {{$order->status}}'s Delivery Status
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
    
    {!! Form::model($order, [		
	    'method' => 'PUT',
        'route' => ['order.update', $order->order_id],
	]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">     
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Status</label>    
                    <div class="col-sm-3">                              
                        <select name="status" class="form-control">
                            <option value="Pending" selected>Pending</option>
                            <option value="Delivered">Delivered</option>                           
                        </select>
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Update" class="btn btn-success"/>
                        <a href="{{ route('order.show',$order->order_id) }}" class = "btn btn-danger" > Cancel </a>  
                    </div>       
                </div>                
                
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}

@endsection