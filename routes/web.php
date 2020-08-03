<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/**
 *
 * Front end routes with vue
 *
 */

	// Route::any('/{any}','VueController@index')->where('any', '.*');

	// Route::get('/', [
	// 	'uses'	=> 'VueController@index',
	// 	'as'	=> 'home-page'
	// ]);

	// Route::get('/get-categories', 'VueController@getCategories');
	// Route::get('/all-products', 'VueController@allProducts');
	// Route::get('/all-products-by-category/{id}', 'VueController@allProductsByCategory');
	// Route::get('/single/{id}', 'VueController@singleProductDetails');
/**
 *
 * Route for front end (without vue)
 *
 */
	Route::get('/', [
		'uses'	=> 'ShopController@index',
		'as'	=> 'home-page'
	]);

	Route::get('/page/details/{url}', [
		'uses'	=> 'ShopController@page',
		'as'	=> 'page-details'
	]);

	Route::get('/brand/details/{id}', [
		'uses'	=> 'ShopController@brand',
		'as'	=> 'brand-details'
	]);

	Route::get('/category/details/{id}', [
		'uses'	=> 'ShopController@category',
		'as'	=> 'category-details'
	]);

	Route::get('/single-product/details/{id}', [
		'uses'	=> 'ShopController@single',
		'as'	=> 'single-product-details'
	]);

	Route::post('/cart/add',[
		'uses'	=> 'CartController@add',
		'as'	=> 'add-to-cart'
	]);

	Route::get('/cart/show',[
		'uses'	=> 'CartController@show',
		'as'	=> 'show-cart'
	]);

	Route::post('/cart/update',[
		'uses'	=> 'CartController@update',
		'as'	=> 'update-cart'
	]);

	Route::get('/cart/delete/{id}',[
		'uses'	=> 'CartController@delete',
		'as'	=> 'delete-cart-item'
	]);

	Route::get('/checkout', [
		'uses'	=> 'CheckoutController@index',
		'as'	=> 'checkout'
	]);

	Route::post('/customer/registration/', [
		'uses'	=> 'CheckoutController@customerSignUp',
		'as'	=> 'customer-sign-up'
	]);

	Route::post('/checkout/customer-login/', [
		'uses'	=> 'CheckoutController@customerLoginCheck',
		'as'	=> 'customer-login'
	]);

	Route::post('/checkout/customer-logout/', [
		'uses'	=> 'CheckoutController@customerLogout',
		'as'	=> 'customer-logout'
	]);

	Route::get('/checkout/new-customer-login/', [
		'uses'	=> 'CheckoutController@newCustomerLogin',
		'as'	=> 'new-customer-login'
	]);

	Route::get('/checkout/existing-customer-login/', [
		'uses'	=> 'CheckoutController@existingCustomerLogin',
		'as'	=> 'existing-customer-login'
	]);

	Route::get('/checkout/shipping/', [
		'uses'	=> 'CheckoutController@shippingForm',
		'as'	=> 'checkout-shipping'
	]);

	Route::get('/checkout/shipping-edit/', [
		'uses'	=> 'CheckoutController@shippingFormEdit',
		'as'	=> 'checkout-shipping-edit'
	]);

	Route::post('/shipping/save/', [
		'uses'	=> 'CheckoutController@saveShippingInfo',
		'as'	=> 'new-shipping'
	]);

	Route::post('/shipping/update/', [
		'uses'	=> 'CheckoutController@updateShippingInfo',
		'as'	=> 'update-shipping'
	]);

	Route::get('/checkout/payment/', [
		'uses'	=> 'CheckoutController@paymentForm',
		'as'	=> 'checkout-payment'
	]);

	Route::post('/checkout/order/', [
		'uses'	=> 'CheckoutController@newOrder',
		'as'	=> 'new-order'
	]);

	Route::get('/complete/order', [
		'uses'	=> 'CheckoutController@completeOrder',
		'as'	=> 'complete-order'
	]);


/**
 *
 * Route for Ajax
 *
 */
	Route::get('/ajax-email-check/', [
		'uses'	=> 'CheckoutController@ajaxEmailCheck',
		'as'	=> 'ajax-email-check'
	]);

/**
 *
 * Tentative front end route
 *
 */

// Route::get('/', function(){
// 	return view('front-end.tentative-front-page');
// });

/**
 *
 * Shop admin panel routing
 *
 */

Route::group(['middleware' => 'ActiveStatusCheckMiddleware'], function(){

	Route::get('/dashboard', [
		'uses'	=> 'DashboardController@index',
		'as'	=> 'dashboard'
	]);

	Route::resource('product', 'ProductController');

	Route::get('/product/unpublish/{id}', [
		'uses'	=> 'ProductController@unpublish',
		'as'	=> 'unpublish-product'
	]);

	Route::get('/product/publish/{id}', [
		'uses'	=> 'ProductController@publish',
		'as'	=> 'publish-product'
	]);

	Route::get('user-prfile', [
		'uses'	=> 'UserController@profile',
		'as'	=> 'user-profile'
	]);

});



Route::group(['middleware' => ['ActiveStatusCheckMiddleware', 'AdminMiddleware']], function (){

	Route::resources([
		'category' => 'CategoryController',
		'brand'    => 'BrandController',
		'page'    => 'StaticPageController',
		'setting' => 'SettingController'
	]);

	Route::get('/category/unpublish/{id}', [
		'uses'	=> 'CategoryController@unpublish',
		'as'	=> 'unpublish-category'
	]);

	Route::get('/category/publish/{id}', [
		'uses'	=> 'CategoryController@publish',
		'as'	=> 'publish-category'
	]);

	Route::get('/brand/unpublish/{id}', [
		'uses'	=> 'BrandController@unpublish',
		'as'	=> 'unpublish-brand'
	]);

	Route::get('/brand/publish/{id}', [
		'uses'	=> 'BrandController@publish',
		'as'	=> 'publish-brand'
	]);

	Route::get('/page/unpublish/{id}', [
		'uses'	=> 'StaticPageController@unpublish',
		'as'	=> 'unpublish-page'
	]);

	Route::get('/page/publish/{id}', [
		'uses'	=> 'StaticPageController@publish',
		'as'	=> 'publish-page'
	]);

	/**
	 *
	 * Order management
	 *
	 */

	Route::get('/order/manage-order', [
		'uses'	=> 'OrderController@manageOrderInfo',
		'as'	=> 'manage-orders'
	]);

	Route::get('/order/view-order-details/{id}', [
		'uses'	=> 'OrderController@viewOrderDetails',
		'as'	=> 'view-order-details'
	]);

	Route::get('/order/view-order-invoice/{id}', [
		'uses'	=> 'OrderController@viewOrderInvoice',
		'as'	=> 'view-order-invoice'
	]);

	Route::get('/order/download-order-invoice/{id}', [
		'uses'	=> 'OrderController@downloadOrderInvoice',
		'as'	=> 'download-order-invoice'
	]);

});


Route::group(['middleware' => ['ActiveStatusCheckMiddleware', 'SuperAdminMiddleware' ]], function(){
	
	Route::resource('user',  'UserController');

	Route::get('/user/unpublish/{id}', [
		'uses'	=> 'UserController@unpublish',
		'as'	=> 'unpublish-user'
	]);

	Route::get('/user/publish/{id}', [
		'uses'	=> 'UserController@publish',
		'as'	=> 'publish-user'
	]);	
});


