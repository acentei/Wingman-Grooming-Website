<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="author" content="Mark Joseph Sibayan">
        <meta name="keywords" content="wingman grooming,pomades,men's grooming">
        
        <meta property="og:url"           content="@yield('meta-url')" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="@yield('meta-title')" />
        <meta property="og:description"   content="@yield('meta-description')" />
        <meta property="og:image"         content="@yield('meta-image')" />

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
        
        {{-- text editor + file manager --}}
        <script src="{!! asset('/css/tinymce/js/tinymce/tinymce.min.js') !!}"></script>        

        <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/css/breakpoints.css') }}">
        
        @yield('styles')

        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

        {{-- elevated zoom --}}
        <script src="{!! asset('/elevatedzoom/jquery.elevatezoom.js') !!}"></script>
        
        @yield('scripts')

        <script type="text/javascript">
            //update cart count
            $(document).ready(function() {

                $.ajax({
                    type: "GET",
                    url: '/webapi/cart/remove-discount',                
                    //url: 'http://localhost:8080/wingmangrooming/public/index.php/webapi/cart/remove-discount',                
                    data: {
                                  
                    },  
                    success: function(data) {
                        //console.log(data);                        
                    },
                    error: function(xhr, status, error) {
                  
                    if(xhr)
                    {
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
                    } 
                });

                setInterval(function() {  
                    //get cart-count                                          
                    $.ajax({
                        type: "GET",
                        url: '/webapi/cart/cart-count',                
                        //url: 'http://localhost:8080/wingmangrooming/public/index.php/webapi/cart/cart-count',                
                        data: {
                                        
                        },
                        success: function(data) {
                            document.getElementById("cartCount").innerHTML = data;
                            document.getElementById("cartCountMob").innerHTML = data;

                        },
                        error: function(xhr, status, error) {
                            
                        if(xhr)
                        {
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
                        }                            

                    });    
                    
                }, 1000);
            });
            
            //navbar
            $(window).scroll(function() {
                if ($(this).scrollTop() > 5)
                {  
                    $('#topbar').addClass("scrollchange");
                    $('.top-header-logo img').attr('src','{{ URL::asset('/images/logo.png') }}');
                }
                else
                {
                    $('#topbar').removeClass("scrollchange");
                    $('.top-header-logo img').attr('src','{{ URL::asset('/images/wg-logo.png') }}');
                                   
                }
            });    
            
        </script>
     
        
    </head> 
    
    <body>
        <div id="topbar">
            <div class="top-header">
                <div class="top-header-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ URL::asset('/images/wg-logo.png') }}">
                    </a>
                </div>
            </div>
            
            <div class="top-header-right">
                <div class="top-header-cart">
                   <a href="{{route('cart.index')}}"> 
                       <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> CART ( <b id="cartCount">{{Cart::count()}}</b> )
                    </a>
                </div>

                {!! Form::open([      
                    'method' => 'GET',
                    'url' => 'shop'
                ]) !!}

                <div class="top-header-search">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span><input id="search" name="search" type="text" placeholder="SEARCH STORE">
                </div>  


                {!! Form::close() !!}

                <div class="navbar-social">
                    <a id="facebook" target="_blank" href="https://www.facebook.com/wingmangrooming" title="Wingman Grooming on Facebook"><img src="{{ URL::asset('/images/icons/fb-icon.png') }}"></a>

                    <a id="instagram" target="_blank" href="https://www.instagram.com/wingman_grooming" title="Wingman Grooming Instagram"><img src="{{ URL::asset('/images/icons/inst-icon.png') }}"></a>

                    <a id="twitter" target="_blank" href="#" title="Wingman Grooming Twitter"><img src="{{ URL::asset('/images/icons/twit-icon.png') }}"></a>
                </div>

        </div>
            
            <div id="navbar">
                @include('layouts.navigation')

                @yield('navigation')
            </div>
        </div>   

        <!--- SIDEBAR ON MOBILE HERE -->
        <div class="mob-nav">
            <div class="nav-icon" style="cursor:pointer" onclick="openNav()"> ≡ </div>

            <div class="mob-cart">
                <a href="{{route('cart.index')}}"> 
                   CART ( <b id="cartCountMob">{{Cart::count()}}</b> )
                </a>
            </div>
        </div>

        <div id="mySidenav" class="sidenav">
            <a href="{{ url('/') }}">HOME</a>
            <a href="{{ route('about.index')}}">ABOUT</a>
            <a href="{{ route('newsletter.index') }}">NEWSLETTER</a>
            <a href="{{ route('shop.index') }}">SHOP</a>       
            <a href="{{ route('contact-us.index') }}">CONTACT US</a>
            <a href="{{ route('wholesale.index') }}">WHOLESALE</a>           
            
            <a id="facebook" href="https://www.facebook.com/wingmangrooming" title="Wingman Grooming on Facebook"><img src="{{ URL::asset('/images/icons/fb-icon.png') }}"></a>
                          
            <a id="instagram" href="https://www.instagram.com/wingman_grooming" title="Wingman Grooming Instagram"><img src="{{ URL::asset('/images/icons/inst-icon.png') }}"></a>
            
            <a id="twitter" href="#" title="Wingman Grooming Twitter"><img src="{{ URL::asset('/images/icons/twit-icon.png') }}"></a>

            {{-- <ul class="nav">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul> --}}

            {!! Form::open([      
                'method' => 'GET',
                'url' => 'shop'
            ]) !!}

                <div class="mob-search">
                    </span><input id="search" name="search" type="text" placeholder="SEARCH STORE">
                </div>

            {!! Form::close() !!}

        </div>
        <!--- UP TO HERE -->         
        
        <div class="header">
            @yield('header')
        </div>
        
        <div class="container">
            <div class="content">                
                @if(Session::has('flash_message'))
                    <div id="flash_success" class="alert alert-success">
                        <i><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></i> <b>{{ Session::get('flash_message') }}</b>
                    </div>  
                @endif

                @if(Session::has('error_message'))
                    <div id="flash_danger" class="alert alert-danger">
                        <i><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> </i><b>{{ Session::get('error_message') }}</b>
                    </div>                
                @endif


                @yield('content')                
                
            </div>             
        
        </div>
        
        @include('layouts.footer')
        
        @yield('footer')        
        
    </body>
</html>
