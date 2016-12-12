
@section('title')
    Wingman Grooming | Login
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Wingman Grooming | Login
@endsection

@section('meta-description')
    Online retailer of Men's Grooming Products.
@endsection

@section('meta-image')
	
@endsection

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="author" content="Mark Joseph Sibayan">
        <meta name="keywords" content="wingman grooming,pomades,men's grooming">
        
        <meta property="og:url"           content="{{Request::url()}}" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="Wingman Grooming | Login" />       

        <title>Wingman Grooming | Login</title>    

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <style type="text/css">
            
            body
            {
                background: #000;
                padding: 0;
                margin: 0;
                width: 100%;
                height: 100%;
            }
            
            .logo-wm
            {
                display: block;
                width: 100%;
                text-align: center;
                margin: 30px auto;
            }
            
            .box-container
            {
                width: 100%;
                height: 100%;
            }
            
            .box
            {
                padding: 20px;
                margin: auto;
                width: 40%;
                height: 40%;
                background-color: rgba(255, 255, 255, 0.7);
                border: 1px solid #fff;
                border-radius: 10px;
                font-size: 20pt;
            }
             
            .box .input-group
            {
                padding-bottom: 10px;
            }
            
            .input-group-addon
            {
                background: #fff;
            }
            
            .remember-me
            {
                width: 100%;
                display: block;
                margin: auto;
                font-size: 8pt;
                text-align: center;
            }
            
            .remember-me a
            {
                font-size: 8pt;
                color:#555;
            }
            .btn-primary
            {
                color: #fff;
                background-color: #000;
                border-color: #555;
            }
            
            .btn-primary:hover
            {
                color: #fff;
                background-color: #111;
                border-color: #555;
            }
            
            div#error
            {
                width: 40%;                
                margin: auto;
            }

            @media only screen and (max-device-width : 767px)
            {
                .box
                {
                    width: 80%;
                }
            }
        </style>
    </head>

    <body>
        <div class="box-container">
            
            <div class="logo-wm">
                <img src="{{ URL::asset('/images/logo.png') }}">
            </div>

            @if (count($errors) > 0)
                <div id="error" class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br>
            @endif

            <div class="box">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/authenticate') }}">                    
                    <br>
                    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                        <input id="user" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    
                    <div class="remember-me">
                        {{-- <input type="checkbox" name="remember"> Remember me<br> --}}                
                        {{-- <a href="#">Forgot password?</a> --}}
                    </div>       

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>  
                </form>
            </div>
        </div>
    </body>
</html>

