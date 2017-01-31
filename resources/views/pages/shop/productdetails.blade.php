@extends('layouts.master')

@section('title')
     | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 | Wingman Grooming
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

@section('header')
    <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
      <!-- Indicators -->
      
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        
        
            <li data-target="#myCarousel" data-slide-to="1"></li>
       

       
            <li data-target="#myCarousel" data-slide-to="2"></li>
       

       
            <li data-target="#myCarousel" data-slide-to="3"></li>
       
      </ol>

      <div class="carousel-inner">

        <div class="item active"> 
            <img src="http://coolwildlife.com/wp-content/uploads/galleries/post-3004/Fox%20Picture%20003.jpg" alt="First slide">
        </div>
        
        
            <div class="item"> 
                <img src="https://pbs.twimg.com/profile_images/495991976781561857/gQ-bU0zx.jpeg" data-src="" alt="Second slide">
            </div>
        
          
       
            <div class="item">
                <img src="#" data-src="" alt="Third slide">
            </div>
       
        
        
            <div class="item"> 
                <img src="#" data-src="" alt="Fourth slide">
            </div>


      </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div> 

@endsection


@section('content')

<div class="mobdet-container">  
    <div class="mobdet-shop-name">
        NAME HERE
    </div>

    <div class="mobdet-product-name">
        Name here
    </div> 

    <div class="mobdet-holder">
        <div class="mobdet-product-price">
           price
        </div> 

      <!--- if 
            <div class="proddet-outofstock">
                Out of Stock!
            </div>
         -->
    
            <div class="proddet-quantity">
                Quantity
                <div class="prod-hover-add">
                    <div class="prod-hover-add">
                                <input id="prodQty" class="prh-num" type="number" min="1" max="" value="1" placeholder="1">
        <input id="prodAddCart" type="button"  class="prh-btn addCart" value="ADD TO CART" data-href="" data-id="" data-productcode="" data-checkout="{{route('cart.index')}}" data-image="" data-name="" data-stock="" data-price="" data-toggle = "modal" data-target = "#addCartSuccess"> 
                        
                    </div>
                </div>
            </div>   

    </div>       

    <hr style="border-color:#999; width:100%; clear:both; float: none;">

    <div class="mobdet-properties">
        <div class="proddet-properties">
             <b>name :</b>  value <br>
        </div>

            <div class="proddet-properties">                                                 description here
               
            </div>
        

        <hr style="border-color:#999; width:100%;">

        <div class="mobdet-related-items">

            <span>RELATED ITEMS</span>

            <div class="mobdet-related-holder">
 

                
                            <a href="#">
                                <div class="mobdet-related-image">
                                    <img src="https://pbs.twimg.com/profile_images/495991976781561857/gQ-bU0zx.jpeg">
                                </div>
                            </a>

                            <div class="proddet-related-details">
                                Name
                                <br>
                                Price
                            </div>
                            <br><br>
 
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