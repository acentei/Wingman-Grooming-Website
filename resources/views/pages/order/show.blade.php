@extends('layouts.master')

@section('title')
    Order #{{$order->order_code}}
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Order #{{$order->order_code}}
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
    <br>

    <div id="panel-style" class="panel panel-primary">  
        
        <div class="panel-body">
            
            <div class="form-horizontal">  

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Order Code</label>    
                    <div class="shop-show-col col-sm-5">                              
                        <b>{{$order->order_code}}</b>
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Order Date</label>    
                    <div class="shop-show-col col-sm-5">                              
                        {{date('M d, Y h:iA', strtotime($order->created_date))}}
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Order Delivery</label>    
                    <div class="shop-show-col col-sm-3">                              
                        <span class="label label-danger">{{$order->order_status}}</span>
                        <a class="btn btn-primary btn-order-status" href="{{ route('order.edit', $order->order_id) }}">Edit</a>
                    </div>       
                </div>  

                <br>

                <h4><i>CUSTOMER DETAILS</i></h4>
                <hr class="style2">

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Customer Name</label>    
                    <div class="shop-show-col col-sm-3">                              
                        {{$order->customer_full_name}}
                    </div>       
                </div> 

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Customer Address</label>    
                    <div class="shop-show-col col-sm-10">                              
                        {{$order->customer_address}}, {{$order->customer_postal}}
                    </div>       
                </div>   

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Customer E-mail</label>    
                    <div class="shop-show-col col-sm-3">                              
                        {{$order->customer_email}}
                    </div>       
                </div>  

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Contact No.</label>    
                    <div class="shop-show-col col-sm-3">                              
                        {{$order->customer_phone}}
                    </div>       
                </div> 
                <br>
                <h4><i>ORDER DETAILS</i></h4>
                <hr class="style2">

                <table class="table table-striped table-order">
                    <thead>
                        <tr>    
                            <th>Product/s</th>                   
                            <th>Quantity</th>                                                      
                            <th>Total</th> 
                        </tr>
                    </thead>

                    <tbody> 
                        <?php 
                            $subtotal=0;
                        ?>
                        @foreach($order['details'] as $details)
                            <?php 
                                $subtotal=$subtotal+$details->total;
                            ?>
                            <tr>
                                <td>{{$details['product']->name }}</td>
                                <td>{{$details->quantity}}</td>
                                <td><b>Php {{number_format($details->total)}}<b></td>
                            </tr>
                        @endforeach                            
                    </tbody>                     
                </table>

                <div class="form-group">   
                    <label for="title" class="col-sm-9 control-label">SUBTOTAL</label>    
                    <div class="shop-show-col col-sm-2">                              
                       Php <b>{{number_format($subtotal)}}</b>
                    </div>       
                </div>   

                @foreach($order['infos'] as $info)
                    <div class="form-group">   
                        <label for="title" class="col-sm-2 control-label">{{$info->Name}}</label>    
                        <div class="shop-show-col col-sm-10">                              
                            {{$info->Value}}
                        </div>       
                    </div> 
                @endforeach                         
                
            </div>
        </div>
    </div>

@endsection