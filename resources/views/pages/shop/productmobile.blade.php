@extends('layouts.master')

@section('title')
    {{$product->name}} | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	{{$product->name}} | Wingman Grooming
@endsection

@section('meta-description')
    {{$product->description}}
@endsection

@section('meta-image')
	{{$product->photo}}
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')

@endsection

@section('header')
    <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
      <!-- Indicators -->
      
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner caro-prodmob">
        <div class="item active"> <img src="{{$product->photo}}" alt="First slide">
        </div>
          
        <div class="item"> <img src="{{$product->photo_2}}" data-src="" alt="Second slide">
        </div>
          
        <div class="item">
            <img src="{{$product->photo_3}}" data-src="" alt="Third slide">
        </div>
          
         <div class="item"> <img src="{{$product->photo_4}}" data-src="" alt="Fourth slide">
        </div>
      </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div> 

@endsection


@section('content')
                <div class="mobdet-container">  
                        <div class="mobdet-shop-name">
                            {{ $product['brand']->display_name }}
                        </div>
                    
                            <div class="mobdet-product-name">
                                {{ $product->name }}
                            </div> 
                    
                    <div class="mobdet-holder">
                        <div class="mobdet-product-price">
                            {{ $product->price }}
                        </div> 
                          
                        @if($product->stocks == 0)
                            <div class="prod-outofstock">
                                Out of Stock!
                            </div>
                        @else
                        <div class="mobdet-quantity">
                            Quantity
                            <div class="prod-hover-add">
                                <div class="prod-hover-add">
                                    <input id="prodQty" class="prh-num" type="number" min="1" max="" value="1" placeholder="1">                                        
                                <input id="prodAddCart" type="button"  class="prh-btn" value="ADD TO CART" data-href="{{ route('shop.index') }}" data-id="" data-productcode="" data-checkout="{{route('cart.index')}}"
                                    data-image="" data-name="" data-price=""
                                    data-toggle = "modal" data-target = "#addCartSuccess">   
                                </div>
                            </div>
                        </div>   
                        @endif
                 </div>       
                            
                    <hr style="border-color:#999; width:80%; clear:both; float: none;">
                    
                    <div class="mobdet-properties">
                            <div class="product-description">
                                {{$product->description}}
                            </div>
                            <br>
                            <br>
                            @foreach($product['property'] as $prod)  

                                <div class="details-properties">                                                 
                                    <b>{{$prod->name}} :</b>  {{$prod->value}} <br>
                                </div>

                            @endforeach
                    
                  {{--  <hr style="border-color:#999; width:80%;">
 
                 <div class="mobdet-related-items">

                    <span>RELATED ITEMS</span>
                    
                    <div class="mobdet-related-holder">
                        
                        <div class="mobdet-product-container">
                            <div class="mobdet-related-image">
                                <img src="http://placehold.it/190x190">
                            </div>

                            <div class="mobdet-related-details">
                                    Water Based Pomade
                                    <br>
                                    $18.00
                                </div>
                            </div>
                        
                        
                        <div class="mobdet-product-container">
                            <div class="mobdet-related-image">
                                <img src="http://placehold.it/190x190">
                            </div>

                            <div class="mobdet-related-details">
                                    Water Based Pomade
                                    <br>
                                    $18.00
                            </div>
                        </div>
                
                        
                        <div class="mobdet-product-container">
                            <div class="mobdet-related-image">
                                <img src="http://placehold.it/190x190">
                            </div>

                            <div class="mobdet-related-details">
                                    Water Based Pomade
                                    <br>
                                    $18.00
                            </div>
                        </div>
                    </div>
                        
                    </div>
                </div> --}}

@endsection