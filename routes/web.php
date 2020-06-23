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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/register/checkemail','Auth\registercontroller@checkemail');
Route::get('/register/checkusername','Auth\registercontroller@checkusername');
Route::get('/register/checkphone','Auth\registercontroller@checkphone');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified','checklogin','checkadmin:0');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/deleteaccount','deletecontroller@delete_account')->middleware(['auth','web','verified']);

	
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

	// Brand Route
	Route::group(['prefix' => 'brand'],function()
	{
		Route::get('/add','brandcontroller@index');      // Form view call
		Route::post('/insert','brandcontroller@insert'); 	//brand insert
		Route::get('/check','brandcontroller@check'); // ajax check brand unique
		Route::get('/show','brandcontroller@show');  // list all brands
		Route::get('/switch','brandcontroller@status');  //brand status change
		Route::get('/delete/{id}','brandcontroller@delete');   // Delete brand 
		Route::get('/trash','brandcontroller@trash');  // All trash brand
		Route::get('/restore/{id}','brandcontroller@restore'); //Restore Trash brand
		Route::get('/edit/{id}','brandcontroller@edit'); //Edit brand view call
		Route::post('/update/{id}','brandcontroller@update'); //Update brand Change brand 
		Route::get('/checkedit','brandcontroller@checkedit'); //Checkbrand unique while update

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

	// Ideal Route
	Route::group(['prefix' => 'ideal'],function()
	{
		Route::get('/add','idealcontroller@index');      // view call
		Route::post('/insert','idealcontroller@insert'); 	//ideal insert
		Route::get('/check','idealcontroller@check'); // ajax check ideal unique
		Route::get('/show','idealcontroller@show');  // list all ideals
		Route::get('/switch','idealcontroller@status');  //ideal status change
		Route::get('/delete/{id}','idealcontroller@delete');   // Delete ideal 
		Route::get('/trash','idealcontroller@trash');  // All trash ideal
		Route::get('/restore/{id}','idealcontroller@restore'); //Restore Trash ideal
		Route::get('/edit/{id}','idealcontroller@edit'); //Edit ideal view call
		Route::post('/update/{id}','idealcontroller@update'); //Update ideal Change Category 
		Route::get('/checkedit','idealcontroller@checkedit'); //Checkideal unique while update
	});
});













