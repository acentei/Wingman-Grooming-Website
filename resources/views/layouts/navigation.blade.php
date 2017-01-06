@section('navigation')
    <nav class="navbar navbar-default navbar-static-top"> 
        <ul class="nav admin-menu">
            @if (Auth::user())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-briefcase"> </span> Admin<b class="caret"></b></a>

                    <ul class="dropdown-menu">
                        <li><a href="{{route('brand.index')}}">Brands</a></li>
                        <li><a href="{{route('carousel.index')}}">Carousel</a></li>
                        {{-- <li><a href="{{route('newsletter-type.index')}}">Newsletter Types</a></li>                         --}}
                        <li><a href="{{route('product.index')}}">Products</a></li>                        
                        <li><a href="{{route('product-type.index')}}">Product Types</a></li>                        
                        <li><a href="{{route('promo-codes.index')}}">Promo Codes</a></li>   
                        <li><a href="{{route('order.index')}}">Orders</a></li>   
                        <li><a href="{{route('sales.index')}}">Sales</a></li>   
                        <li><a href="{{route('inventory.index')}}">Inventory</a></li>   
                        <li><a href="{{route('shipping-cost.index')}}">Shipping Cost</a></li>   
                        <li class="divider"></li>
                        <li><a href="{{ url('auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>

                    </ul>
                </li>            
            @endif
        </ul>

        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image 
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
                -->
                
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                
                    <ul class="nav navbar-nav">                       
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}" >HOME</a></li>
                        <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ route('about.index') }}">ABOUT</a></li>
                        <li class="{{ Request::is('newsletter') ? 'active' : '' }}"><a href="{{ route('newsletter.index') }}">NEWSLETTER</a></li>
                        <li class="{{ Request::is('shop') ? 'active' : '' }}"><a href="{{ route('shop.index') }}">SHOP</a></li>
                        
                        <li class="dropdown {{ Request::is('contact-us') || Request::is('wholesale') ? 'active' : '' }}"><a href="#" class="dropdown-toggle" data-toggle="dropdown">CONTACT US <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('contact-us.index') }}">Inquiries</a></li>
                                <li><a href="{{ route('wholesale.index') }}">Wholesale</a></li>
                            </ul>
                        </li>
                    </ul>
                
                    
                    
                {{--
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
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
                </ul>
                --}}
            </div>
        </div>
    </nav>

    <script>
        $('ul.nav li.dropdown').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(10).fadeIn(500);
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(10).fadeOut(500);
        });    

        function locationHashChanged() {
            $('ul.navbar-nav li a').removeClass('active'); // remove the active class from all elements
            $('ul.navbar-nav li a[href="' + location.hash + '"]').addClass('active'); // add the active class to the element whose href equals the new fragment identifier ("hashtag")
        }
        window.onhashchange = locationHashChanged; // listen for hash change event
        locationHashChanged(); // add the active class to the appropriate link on initial page load

        var $isOpen = false;
        
        function openNav() {
            if ($isOpen)
                {
                    document.getElementById("mySidenav").style.width = "0"; 
                    $isOpen = false;
                }
            else
                {
                    document.getElementById("mySidenav").style.width = "250px";
                    $isOpen = true;
                }
        }
    </script>

@endsection