<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {    
    return Redirect::route('home.index');
});

Route::get('/order/success', function () {    
    return view('pages.responses.payment');
});

Route::get('/subscribe/success', function () {    
    return view('pages.responses.subscription');
});

Route::get('/subscribe/fail', function () {    
    return view('pages.responses.subsc-exist');
});

Route::get('/inquiry/sent', function () {    
    return view('pages.responses.message');
});

Route::get('/wholesale-inquiry/sent', function () {    
    return view('pages.responses.wholesale');
});

// Route::get('/receipt-email', function () {    
//     return view('pages.emails.receipt-email');
// });

Route::resource('newsletter','NewsletterController');
Route::resource('shop','ShopController');
Route::resource('brand','BrandController');
Route::resource('promo-codes','PromoCodeController');
Route::resource('about','AboutController');
Route::resource('policy','PolicyController');
Route::resource('product-type','ProductTypeController');
// Route::resource('newsletter-type','NewsletterTypeController');
Route::resource('product','ProductController');
Route::resource('cart','CartController');
Route::resource('stockist','StockistController');
Route::resource('faqs','FaqsController');
Route::resource('contact-us','InquiryController');
Route::resource('welcome','WelcomeNoteController');
Route::resource('wholesale','WholesaleController');
Route::resource('home','HomepageController');
Route::resource('carousel','CarouselController');
Route::resource('order','OrderController');
Route::resource('sales','SalesController');
Route::resource('inventory','InventoryController');
Route::resource('shipping-cost','ShippingDetailsController');

/* CUSTOM CONTROLLERS */
Route::get('newsletter/{date}/{slug}', [
    'as' => 'newsletter-show', 'uses' => 'NewsletterController@show']);

Route::get('show-generate','PromoCodeController@showGenerate');
Route::post('generate-code','PromoCodeController@generateCode');

Route::post('subscribe','SubscribingController@subscribe');

Route::controller('webapi/cart','webapi\CartWebapi');
Route::controller('webapi/shop','webapi\ShopWebapi');

Route::group(array('middleware' => 'auth'), function(){
    Route::controller('filemanager', 'FilemanagerLaravelController');
});

//Route::controller('filemanager', 'FilemanagerLaravelController');

//payment gateway
Route::post('payment/checkout', 'PaypalController@postPayment');
Route::get('payment/payment_success', 'PaypalController@getSuccessPayment');
Route::get('payment/cancel_order', function() { return Redirect::route('cart.index'); });

//Route::auth();
//Route::get('/home', 'HomeController@index');

//------------------ AUTHENTICATION ------------------//    
Route::post('auth/authenticate', 'Auth\AuthController@authenticate');

Route::get('auth/logout', 'Auth\AuthController@logout');
Route::get('postregister', 'Auth\AuthController@postRegister');
Route::post('register', 'Auth\AuthController@Register');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    //'webapiauth' =>'Auth\WebApiAuthController'
]);
