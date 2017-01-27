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
    <div id="myCarousel" class="carousel slide mobdet-product" data-ride="carousel"> 
      <!-- Indicators -->
      
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        
        @if($product->photo_2)  
            <li data-target="#myCarousel" data-slide-to="1"></li>
        @endif

        @if($product->photo_3)
            <li data-target="#myCarousel" data-slide-to="2"></li>
        @endif

        @if($product->photo_4)
            <li data-target="#myCarousel" data-slide-to="3"></li>
        @endif
      </ol>

      <div class="carousel-inner caro-prodmob">

        <div class="item active"> 
            <img src="{{$product->photo}}" alt="First slide">
        </div>
        
        @if($product->photo_2)
            <div class="item"> 
                <img src="{{$product->photo_2}}" data-src="" alt="Second slide">
            </div>
        @endif
          
        @if($product->photo_3)
            <div class="item">
                <img src="{{$product->photo_3}}" data-src="" alt="Third slide">
            </div>
        @endif
        
        @if($product->photo_4)
            <div class="item"> 
                <img src="{{$product->photo_4}}" data-src="" alt="Fourth slide">
            </div>
        @endif

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

                        <input id="prodAddCart" type="button"  class="prh-btn addCart" value="ADD TO CART" data-href="{{ route('shop.index') }}" data-id="{{$product->product_id}}" data-productcode="{{$product->product_code}}" data-checkout="{{route('cart.index')}}" data-image="{{$product->photo}}" data-name="{{$product->name}}" data-stock="{{$product->stocks}}" data-price="{{$product->price}}" data-toggle = "modal" data-target = "#addCartSuccess"> 
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

        <br><br>
        
        @foreach($product['property'] as $prod)  
            <div class="details-properties">                                                 
                <b>{{$prod->name}} :</b>  {{$prod->value}} <br>
            </div>
        @endforeach

        <hr style="border-color:#999; width:80%;">

        <div class="mobdet-related-items">

            <span>RELATED ITEMS</span>

            <div class="mobdet-related-holder">
                <?php $i=0; ?>

                @foreach($product['brand']['product'] as $related)  
                    @if($related->product_id != $product->product_id)
                        @if($i < 3)
                            <?php $i++; ?>
                            <a href="{{ route('shop.show',$related->slug) }}">
                                <div class="mobdet-related-image">
                                    <img src="{{$related->photo}}">
                                </div>
                            </a>

                            <div class="mobdet-related-details">
                                {{$related->name}}
                                <br>
                                {{$related->price}}
                            </div>
                            <br><br>
                        @endif
                    @endif
                @endforeach
            </div>

        </div>
    </div> 
</div>

@include('modals.addCartSuccess')


<script type="text/javascript"> 

    $('.addCart').click(function()            
    {
        var id = $(this).attr("data-id");
        var code = $(this).attr("data-productcode");
        var name = $(this).attr("data-name");
        var image = $(this).attr("data-image");
        var price = $(this).attr("data-price");
        var stock = $(this).attr("data-stock");
                 
        var qty = $('#prodQty').val();

        $(this).attr('data-quantity', qty);

        $.ajax({
            type: "POST",
            url: '/webapi/cart/add-cart',                
            data: {
                "id" : id,
                "code" : code,
                "name" : name,
                "image" : image,
                "qty" : qty,
                "price" : price,
                "stock" : stock,
            },  
            success: function(data) {
                //console.log(data);                         
            },
            error: function(xhr, status, error) {
          
            // So we remove everything before the first '{
            var result = xhr.responseText.replace(/[^{]*/i,'');
            console.log(result);
            //We parse the json
            var data = JSON.parse(result);
          
            $('#errorhere').html("<div class='alert alert-danger'></div>");
            // And continue like no error ever happened
            $.each(data, function(i,item){
                $('.alert-danger').append(item + "<br>");
            });
        } 
        });
    });

</script>

@endsection