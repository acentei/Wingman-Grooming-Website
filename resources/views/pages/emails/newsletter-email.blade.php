<!DOCTYPE html>
<html lang="en">

	<head>
		<style>
			@font-face 
			{
			    src: url({{ URL::asset('/fonts/gotham.ttf') }});
			    font-family: 'Gotham';
			    font-style: normal;
			}			

			@font-face 
			{
			    src: url({{ URL::asset('/fonts/BebasNeue.otf') }});
			    font-family: 'BebasNeue';
			    font-style: normal;
			}			

			.content
		    {
		        background:#fff;		        
		    }

		    .response-container
			{
			    background:#f5f5f5;
			    width: 90%;
			    margin: 30px auto;
			    padding: 30px;
			    border: 2px solid #ddd;
			}

			.response-title
			{
			    width: 100%;
			    display: block;
			    font-family: BebasNeue;
			    font-size: 35pt;
			    color:#000;
			    text-align: center;
			    margin: auto;
			}

			.response-note, .response-receipt-note
			{
			    width: 80%;
			    display:block;
			    margin: 30px auto;
			}

			.response-note p
			{
			    background-color: #ebebeb;
			    margin: auto;
			    padding: 25px 110px;
			    font-size: 10pt;
			    line-height: 26px;
			    text-align: center;
			    font-family: Gotham;
			}

			.response-img-container
			{
			    background:#fff;
			    width: 60%;
			    text-align: center;
			    margin: auto;
			    overflow: hidden;
			}


			.response-img-container img
			{
			    width: 100%;
			    height: auto;
			    margin: auto;
			}
		</style>

	</head>

	<body>	
		<div class="content">	
			<div class="response-container">
			    <div class="response-title">
			        <img src="{{ URL::asset('/images/wg-logo.png') }}" width="100px" height="auto" alt="Wingman Grooming Logo">
			    </div>
			    
			    <div class="response-note">
			        <p>
			            New content!<br>
			            View the article and enjoy.<br>
			            Thank you for subscribing!
			        </p>
			    </div>
			    
			    <a href="{{$url}}">
				    <div class="response-img-container">		    
				        {{-- <img src="{{$image}}">		     --}}
				        <img src="https://s-media-cache-ak0.pinimg.com/originals/e5/e7/24/e5e724ae24af119df4052b59eddcc7e5.jpg">
				    </div>	
				</a>	    
			</div>
		</div>

	</body>

</html>