<!DOCTYPE html>
<html lang="en">

	<head>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

		<style>
			html
			{
				font-family: Open Sans;
			}
							
			.content
		    {
		        background:#fff;
		        /*font-family: 'Roboto-Regular,Helvetica,Arial,sans-serif';		        */
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
			    /*font-family: BebasNeue;*/
			    font-size: 35pt;
			    color:#000;
			    text-align: center;
			    margin: auto;
			}

			.response-title-sub
			{
			    color: #bb2229;
			    text-transform: uppercase;
			    text-align: center;
			    /*font-family: Gotham;*/
			    font-weight: bold;
			    font-size: 10pt;
			    letter-spacing: 2px;
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
			    padding: 25px 0px;
			    font-size: 10pt;
			    line-height: 26px;
			    text-align: center;
			    /*font-family: Gotham;*/
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

			    <div class="response-title-sub">
			       	Thank you for subscribing to our website.
			    </div>
			    
			    <div class="response-note">
			        <p>
			        	Here is a promo code you can use in your next purchase.<br>
			            Use <b>{{$code}}</b> to <b>{{$description}}</b>.
			        </p>
			    </div>			    
			</div>
		</div>

	</body>

</html>