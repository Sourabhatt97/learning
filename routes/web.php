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

Route::get('/', function () {
    return view('layout.front.index');
});

Auth::routes(['verify' => true]);

Route::get('/register/checkemail','Auth\registercontroller@checkemail');
Route::get('/register/checkusername','Auth\registercontroller@checkusername');
Route::get('/register/checkphone','Auth\registercontroller@checkphone');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified','checklogin','checkadmin:0');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/deleteaccount','deletecontroller@delete_account')->middleware(['auth','web','verified']);

// Admin Routes

Route::group(['prefix' => 'admin' ,'middleware' => ['web','auth','checkadmin:1'],],function()
{
	Route::get('dashboard','verifycontroller@index');
	Route::get('profile','profilecontroller@index');
	Route::post('/editprofile','profilecontroller@edit');

	Route::get('/checkusername','profilecontroller@checkusername');
	Route::get('/checkemail','profilecontroller@checkemail');
	Route::get('/checkphone','profilecontroller@checkphone');
	
	// Category Route
	Route::group(['prefix' => 'category'],function()
	{
		Route::get('/add','categorycontroller@index');      // view call
		Route::post('/insert','categorycontroller@insert'); 	//category insert
		Route::get('/check','categorycontroller@check'); // ajax check category unique
		Route::get('/show','categorycontroller@show');  // list all categories
		Route::get('/switch','categorycontroller@status');  //category status change
		Route::get('/delete/{id}','categorycontroller@delete');   // Delete Category 
		Route::get('/trash','categorycontroller@trash');  // All trash Category
		Route::get('/restore/{id}','categorycontroller@restore'); //Restore Trash category
		Route::get('/edit/{id}','categorycontroller@edit'); //Edit category view call
		Route::post('/update/{id}','categorycontroller@update'); //Update category Change Category 
		Route::get('/checkedit','categorycontroller@checkedit'); //Checkcategory unique while update

	});

	// Subcategory Route
	Route::group(['prefix' => 'subcategory'],function()
	{
		Route::get('/add','subcategorycontroller@index');      // view call
		Route::post('/insert','subcategorycontroller@insert'); 	//subcategory insert
		Route::get('/check','subcategorycontroller@check'); // ajax check subcategory unique
	});

	//Color Route
	Route::group(['prefix' => 'color'],function()
	{
		Route::get('/add','colorcontroller@index'); // Form View call
		Route::post('/insert','colorcontroller@insert'); 	//color insert
		Route::get('/check','colorcontroller@check'); // ajax check color unique
		Route::get('/show','colorcontroller@show');  // list all Colors
		Route::get('/switch','colorcontroller@status');  //Color status change
		Route::get('/delete/{id}','colorcontroller@delete');   // Delete Color 
		Route::get('/trash','colorcontroller@trash');  // All trash Color
		Route::get('/restore/{id}','colorcontroller@restore'); //Restore Trash color
		Route::get('/edit/{id}','colorcontroller@edit'); //Edit color view call
		Route::post('/update/{id}','colorcontroller@update'); //Update color Change Color Name
		Route::get('/checkedit','colorcontroller@checkedit'); //Checkcolor unique while update
	});

	// Product Route
	Route::group(['prefix' => 'product'],function()
	{
		Route::get('/add','productcontroller@index');// Form View Call
		Route::post('/insert','productcontroller@insert'); // Product insert
		Route::get('/checkproduct','productcontroller@checkproduct'); // Check product name unique
		Route::get('/checkupc','productcontroller@checkupc');// Check product UPC unique
		Route::get('/show','productcontroller@show');  // list all Products
		Route::get('/switch','productcontroller@status'); //Product Change Status
		Route::get('/delete/{id}','productcontroller@delete'); //Delete Product
		Route::get('/trash','productcontroller@trash'); // All trash product
		Route::get('/restore/{id}','productcontroller@restore');  // Restore all products
		Route::get('/edit/{id}','productcontroller@edit'); // Edit product view call
		Route::post('/update/{id}','productcontroller@update'); //Update product change product name 
		Route::get('/checkeditname','productcontroller@checkeditname'); // Check product name unique edit 
	});

	Route::group(['prefix' => 'order'],function()
	{
		Route::get('/list','ordercontroller@index');
		Route::get('/view/{id}','ordercontroller@orderview');
	});
});


// Client Routes
Route::get('/',function()
{
	return view('layout.front.index');
});


Route::get('/products','productsviewcontroller@index'); // Watches page call
Route::get('/productfilter','productsviewcontroller@productfilter'); // Filteration of Watches

Route::get('/productdetail/{access_url}','productsviewcontroller@productdetail');
Route::get('/addcart','cartcontroller@addcart');
Route::get('/get_mini_cart','cartcontroller@getminicart');
Route::get('/remove_mini_cart','cartcontroller@removeminicart');
Route::get('/viewcart','cartcontroller@getfullcart');

Route::get('/remove_product/{id}','cartcontroller@removeproduct');

Route::group(['middleware' => ['web','auth','checkadmin:0'],],function()
{
	Route::get('billing','billingcontroller@index');
	Route::post('/billing/add','billingcontroller@add');
	Route::get('/paymenttype','billingcontroller@paymenttype');
	// Route::get('/printinvoicepdf/{id}','billingcontroller@printinvoicepdf');
	// Route::post('/stripepayment','paymentcontroller@stripepayment');
});

// Route::get('/payment', 'PaymentController@index');
Route::post('/charge', 'paymentcontroller@charge');

Route::get('/test',function()
{
	return view('test');
});