@extends('layouts.master')

@section('title')
    Shop | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Shop | Wingman Grooming
@endsection

@section('meta-description')
    Store
@endsection

@section('meta-image')
	
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    <div class="shop-container"> 
        <div id="brandName" class="shop-brand-name">ALL</div>

        <div class="shop-category">                    
            <a id="cat0" href="{{ route('shop.index', ['filter' => Session::get('filter'),'category' => 'All','brand' => Session::get('brand_name')])}}">ALL</a>                
            <!-- LOAD ALL AVAILABEL PRODUCT TYPE -->
            @foreach($prodtype as $type)                    
                <a id="cat{{$type->product_type_id}}" href="{{ route('shop.index', ['filter' => Session::get('filter'),'category' => $type->display_name, 'brand' => Session::get('brand_name')]) }}">                    
                    {{$type->display_name}}                    
                </a>                    
            @endforeach                
        </div>

        <hr style="width:100%;margin:10px;">
        
        @if($isSearch)
            <div class="shop-result">
                "(<b>{{count($products)}}</b>) result/s found for <u>{{$search}}</u>"
            </div>
        @endif       

        <div class="shop-listing">
            <div class="shop-left">
                <div class="shop-browse-title">
                    FILTER
                </div>
                
                <div class="shop-browse-list">
                    <select id="dd-filter" class="dd-general" onchange="filter();">
                        <option value="{{ route('shop.index', ['filter' => 'name-asc','brand' => Session::get('brand_name'),'category' => Session::get('type_name')])}}" selected>Alphabetical(A-Z)</option>
                        <option value="{{ route('shop.index', ['filter' => 'name-desc','brand' => Session::get('brand_name'),'category' => Session::get('type_name')])}}">Alphabetical(Z-A)</option>
                        <option value="{{ route('shop.index', ['filter' => 'price-asc','brand' => Session::get('brand_name'),'category' => Session::get('type_name')])}}">Lowest Price</option>
                        <option value="{{ route('shop.index', ['filter' => 'price-desc','brand' => Session::get('brand_name'),'category' => Session::get('type_name')])}}">Highest Price</option>
                        <option value="{{ route('shop.index', ['filter' => 'created_date-desc','brand' => Session::get('brand_name'),'category' => Session::get('type_name')])}}">Newest</option>
                        <option value="{{ route('shop.index', ['filter' => 'created_date-asc','brand' => Session::get('brand_name'),'category' => Session::get('type_name')])}}">Oldest</option>

                    </select>
                </div>
                
                <div class="shop-browse-title">
                    BROWSE BY BRANDS
                </div>
                
                <div class="shop-browse-list">
                    <a id="brand0" href="{{ route('shop.index', ['filter' => Session::get('filter'),'brand' => 'All','category' => Session::get('type_name')])}}">
                        <div class="browse-list-name">All</div>
                    </a>          

                    <select class="mobdet-browse-list">
                        <option value="All">ALL</option>
                        
                        @foreach($brand as $brands)
                            <option value="{{$brands->display_name}}">{{$brands->display_name}}</option>
                        @endforeach
                    </select>
                    
                    <!-- LOAD ALL AVAILABEL PRODUCT TYPE -->
                    @foreach($brand as $brand)                    
                        <a id="brand{{$brand->brand_id}}" href="{{ route('shop.index', ['filter' => Session::get('filter'),'brand' => $brand->display_name,'category' => Session::get('type_name')]) }}">
                            <div class="browse-list-name">
                                {{$brand->display_name}}
                            </div>
                        </a>
                    @endforeach
                    
                </div>
            </div>

            <div class="shop-right">
                
                <div class="shop-products">
                    @foreach($products as $key=>$product)
                        
                        <div class="shop-product-container">
                            <?php 
                                $datetime1 = date('Y-m-d H:i', strtotime($now));
                                $datetime2 = date('Y-m-d H:i', strtotime($product->created_date));

                                $date1 = DateTime::createFromFormat('Y-m-d H:i',$datetime1);
                                $date2 = DateTime::createFromFormat('Y-m-d H:i',$datetime2);
                                $interval = $date1->diff($date2);                     
                            ?>

                            @if($product->stocks == 0)
                                <div class="item-outofstock">
                                    Out of Stock!
                                </div>      

                            @elseif($interval->d <= 14)                      
                                 <div class="item-isNew">
                                    NEW!
                                </div>   
                            @endif

                            <div class="shop-product-image">

                                <img src="{{$product->photo}}" width="190px" height="190px">
                                                               
                                <div class="shop-product-hover">  
                                    <div class="prod-hover-top">
                                        <a href="#" class="shop-notmob" data-toggle = "modal" data-target = "#showProductDetails"  
                                            data-image1="{{$product->photo}}" data-image2="{{$product->photo_2}}" 
                                            data-image3="{{$product->photo_3}}" data-image4="{{$product->photo_4}}"
                                            data-name="{{$product->name}}" data-price="{{$product->price}}" 
                                            data-description="{{$product->description}}" data-details="{{$product['property']}}"
                                            data-related="{{$product['brand']['product']}}"
                                            data-id="{{$product->product_id}}" data-productcode="{{$product->product_code}}" 
                                            data-stock="{{$product->stocks}}" data-brandname="{{$product['brand']->display_name}}"
                                            data-tags="{{json_encode($product->tags)}}">
                                            
                                            <span class="glyphicon glyphicon-search" style="color: black;"></span>
                                        </a>

                                        <a href="{{ route('shop.show',$product->slug) }}" class="shop-mob">
                                            <span class="glyphicon glyphicon-search" style="color: black;"></span>
                                        </a>
                                    </div>
                                    
                                    @if($product->stocks != 0)
                                        <div class="prod-hover-details shop-notmob">
                                            Quantity
                                            <div class="prod-hover-add">
                                                <input id="numQty{{$key}}" class="prh-num itemQty" type="number" value="1" min="1" max="{{$product->stocks}}" placeholder="1">
                                                <input id="btnAC{{$key}}" type="button"  class="prh-btn addCart" value="ADD TO CART" data-href="{{ route('shop.index') }}" data-id="{{$product->product_id}}" data-productcode="{{$product->product_code}}" data-checkout="{{route('cart.index')}}"
                                                    data-image="{{$product->photo}}" data-name="{{$product->name}}" data-stock="{{$product->stocks}}" data-price="{{$product->price}}"
                                                    data-toggle = "modal" data-target = "#addCartSuccess">                                       

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="shop-product-details">
                                <div class="prod-detail-name">
                                    {{$product->name}}
                                </div>

                                <div class="prod-detail-price">
                                    Php {{$product->price}}
                                </div>
                            </div>
                            
                        </div>
                    
                    @endforeach
                    
                    
                </div>

                <div class="custom-pagination">
                    {!! $products->render(new \Illuminate\Pagination\BootstrapThreePresenter($products)) !!}
                </div>
                
            </div>
        </div>
    </div>

    @include('modals.addCartSuccess')
    @include('modals.productDetails')

    <script type="text/javascript"> 
  
        $('.addCart').click(function()            
        {
            var id = $(this).attr("data-id");
            var code = $(this).attr("data-productcode");
            var name = $(this).attr("data-name");
            var image = $(this).attr("data-image");
            var price = $(this).attr("data-price");
            var stock = $(this).attr("data-stock");

            var input = $(this).attr("id").replace('btnAC','');             
            var qty = $('#numQty'+input).val();

            $(this).attr('data-quantity', qty);

            console.log('id: '+id);

            $.ajax({
                type: "POST",
                //url: '/webapi/cart/add-cart',                
                url: 'http://localhost:8080/wingmangrooming/public/index.php/webapi/cart/add-cart',                
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
    
        $('.mobdet-browse-list').on('change',function()            
        {
            var brandName = $(this).val();
            var cat = '{{Session::get("type_name")}}';

            if(cat)
            {
                window.location = window.location.pathname+"?brand="+brandName+"&category="+cat;
            }
            else
            {
                window.location = window.location.pathname+"?brand="+brandName;
            }
            
        });



        //setActive Category
        $(document).ready(function(){
            var category_class = $.cookie('cat_class');           
            var category_id = $.cookie('cat_id');       

            if(category_class)
            {
                var cat = $('.shop-category a#'+category_id);                
                cat.attr('class', category_class);
            }
            else
            {
                $('a#cat0').addClass('active');
            }

            $('.shop-category a').click(
                function(e)
                {
                    $('a#cat0').removeClass('active');
                    $(e.currentTarget).addClass('active');

                    $.cookie('cat_class', $(e.currentTarget).attr('class')); 
                    $.cookie('cat_id', $(e.currentTarget).attr('id'));   
                }
            );
        }); 

        //setActive brand
        $(document).ready(function(){

            //session
            var active_brand = '{{Session::get("brand_name")}}';            
            var decoded = $("<div/>").html(active_brand).text();

            if(active_brand)
            {
                var brandName = document.getElementById('brandName'); 
                brandName.innerHTML = active_brand;   

                $(".mobdet-browse-list").val(decoded);
            }
            else
            {
                var brandName = document.getElementById('brandName'); 
                brandName.innerHTML = 'All';

                $(".mobdet-browse-list").val('All') ;
            }

            //cookie
            var brand_class = $.cookie('brand_class');
            var brand_id = $.cookie('brand_id');

            if((brand_class) && (brand_id))
            {
                var toBrowse = $('.shop-browse-list a#'+brand_id).find('.browse-list-name');
                toBrowse.attr('class', brand_class);

                var brandName = document.getElementById('brandName'); 
                brandName.innerHTML = $('.shop-browse-list a#'+brand_id).text();
            }
            else
            {
                var toInactive = $('.shop-browse-list a#brand0').find('.browse-list-name');
                toInactive.addClass('list-active');

                {{Session::put("brand_name",'All')}};
            }

            $('.shop-browse-list a').click(function() {

                    var toInactive = $('.shop-browse-list a#brand0').find('.browse-list-name');
                    toInactive.removeClass('list-active');

                    var toBrowse = $(this).find('.browse-list-name');
                    toBrowse.addClass('list-active');

                    var brandName = document.getElementById('brandName'); 
                    brandName.innerHTML = $(this).text();

                    $.cookie('brand_class', toBrowse.attr('class'));                   
                    $.cookie('brand_id', $(this).attr('id'));                   
                });
        });

        //setActive filter
        $(document).ready(function(){
            $('#dd-filter').val(window.location.href);
        });
        
        //filter page
        function filter()
        {
            window.location.href = document.getElementById('dd-filter').value;
        }

    </script> 

@endsection