@extends('layouts.master')

@section('title')
    Order List
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Order List
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
    <div class="cms-table">
        <h1 class="h1-table-title"><b>Order List</b></h1>

        <table class="table table-striped">
            <thead>
                <tr>	
                    <th>Order Code</th>                   
                    <th>Date</th>                                                      
                    <th>Customer</th>                   
                    <th>Email</th>              
                    <th>Delivery</th>             
                    <th></th>				
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order) 
                    <tr>
                        <td>{{$order->order_code}}</td>	                    
                        <td>{{date('M d, Y', strtotime($order->created_date))}}</td>
                        <td>{{$order->customer_full_name}}</td>  
                        <td>{{$order->customer_email}}</td>  
                         
                        @if($order->order_status == "Pending")
                            <td>
                                <span class="label label-danger">{{$order->order_status}}</span>                               
                            <td> 
                        @elseif($order->order_status == "Delivered")
                            <td><span class="label label-success">{{$order->order_status}}</span></td>
                            <a class="btn btn-primary btn-order-status" href="#">Edit</a>
                        @endif

                        <td><a href="{{route('order.show',$order->order_id)}}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-eye-open"></span></td>  
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        <div class="custom-pagination">
            {!! $orders->render(new \Illuminate\Pagination\BootstrapThreePresenter($orders)) !!}
        </div>
    </div>
@endsection