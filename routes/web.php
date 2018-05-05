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


/*
 * User Side Routes
*/

Route::get('/login','UserLoginController@index')->name('login');
Route::post('/login','UserLoginController@login');
Route::get('/logout','UserLoginController@logout');
Route::get('/register','UserRegisterController@index');
Route::post('/register','UserRegisterController@register');
Route::get('/forget-password','UserLoginController@showForget');
Route::post('/forget-password','UserLoginController@resetPass');
Route::get('/checkpoint','CheckpointController@index')->middleware('auth');
Route::post('/checkpoint','CheckpointController@check')->middleware('auth');
Route::get('/checkpoint/resend','CheckpointController@resend')->middleware('auth');



Route::group(['middleware'=>['approve','auth']],function (){
    Route::get('/dashboard','UserHomeController@index');
    Route::get('/missions','UserHomeController@showMission');
    Route::get('/missions/click/{id}','UserHomeController@getClick');
    Route::get('/missions/CE4129F6ABFCA997784923DE8C31004116329453CE4129F6ABFCA997784923DE8C31004116329453','UserHomeController@clickCheck');
    Route::get('/prizes','UserHomeController@showPrize');
    Route::get('/prizes/form/{id}','UserHomeController@orderPage');
    Route::post('/prizes/order/{id}','UserHomeController@orderPrize');
    Route::get('/myorders','UserHomeController@myOrders');
    Route::get('/profile','UserHomeController@showProfile');
    Route::post('/profile','UserHomeController@updateProfile');
    Route::post('/profile/password','UserHomeController@updatePassword');
});



/*
 * Admin side routes
 */
Route::get('cpanel/login','AdminController@index');
Route::post('cpanel/login','AdminController@login');
Route::get('cpanel/logout','AdminController@logout');

Route::group(['middleware'=>'adminAuth','prefix'=>'/cpanel'],function (){
    Route::get('/home','AdminController@dashboard');
    Route::get('/point-reset','AdminController@showPointReset');
    Route::post('/point-reset','AdminController@pointReset');
    Route::get('/mission','AdminController@showMission')->name('AdminMission');
    Route::post('/mission','AdminController@addMission');
    Route::get('/mission/delete/{id}','AdminController@deleteMission');
    Route::get('/prize','AdminController@showPrize');
    Route::post('/prize','AdminController@addPrize');
    Route::get('/prize/delete/{id}','AdminController@deletePrize');
    Route::get('/prize/restock','AdminController@restock');
    Route::get('/orders','AdminController@orderShow');
    Route::post('/orders/status/{id}','AdminController@orderStatus');
    Route::get('/user-manager','AdminController@showUsers');
    Route::get('/user-manager/search','AdminController@showSearchUsers');
    Route::post('/user-manager/action/{id}','AdminController@actionUsers');
    Route::get('/post','AdminController@showPost');
    Route::post('/post','AdminController@makePost');
    Route::get('/post/delete/{id}','AdminController@deletePost');
});