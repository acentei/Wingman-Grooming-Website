@extends('layouts.master')

@section('title')
    Inventory
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Inventory
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
        <h1 class="h1-table-title"><b>Product List</b></h1>

        <div class="shop-products">
            
            @foreach($products as $product)
                <div class="shop-product-container prod-list">
                    <div class="shop-product-image">
                        <img src="{{$product->photo}}" width="190px" height="190px">
                    </div>

                    <div class="shop-product-details">
                        <div class="prod-detail-name">
                            {{$product->name}}
                        </div>

                        <div class="prod-detail-price">
                            Stock: {{$product->stocks}}
                        </div>
                    </div>
                    
                    <br>
                    
                    <a href="{{route('inventory.edit',$product->product_id)}}" class="btn btn-warning" role="button"> <span class="glyphicon glyphicon-edit"></span><b> Update Stock</b></a>
                </div>
            @endforeach
        </div>

        <br>

        <div class="custom-pagination">
            {!! $products->render(new \Illuminate\Pagination\BootstrapThreePresenter($products)) !!}
        </div>

    </div>
@endsection