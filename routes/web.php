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
		Route::post('/update/{id}','categorycontroller@update'); //Update category Change Category Name
		Route::get('/checkedit','categorycontroller@checkedit'); //Checkcategory unique while update

	});

	//Color Route
	Route::group(['prefix' => 'color'],function()
	{
		Route::get('/add','colorcontroller@index'); // View call
		Route::post('/insert','colorcontroller@insert'); 	//color insert
		Route::get('/check','colorcontroller@check'); // ajax check color unique
		Route::get('/show','colorcontroller@show');  // list all Colors
		Route::get('/switch','colorcontroller@status');  //Color status change
		Route::get('/delete/{id}','colorcontroller@delete');   // Delete Color 
		Route::get('/trash','colorcontroller@trash');  // All trash Color
		Route::get('/restore/{id}','colorcontroller@restore'); //Restore Trash color
		Route::get('/edit/{id}','colorcontroller@edit'); //Edit color view call
		Route::post('/update/{id}','colorcontroller@update'); //Update color Change Category Name
		Route::get('/checkedit','colorcontroller@checkedit'); //Checkcolor unique while update


	});
});



















