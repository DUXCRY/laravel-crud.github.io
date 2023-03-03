<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, function () {
    return view('/dashboard/index');
}])->middleware('auth');



// Route::get('/', 'DashboardController@index', function () {
//     return view('/dashboard/index');
// })->middleware('auth');

Route::get('/customer/list',  function () {
    return view('customer/list', ['name' => 'customer.list']);
});

Route::get('/order/all', 'OrderController@all', function () {
    return view('order/all');
})->name('order.all');

Route::get('/order/{order}/print', 'OrderController@generateInvoice', function () {
    return view('order/print');
})->name('order.print');

Route::delete('item/{id}', 'OrderController@deleteProduct', function () {
    return redirect()->back();
})->name('order.delete_product');

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('customer/caesar', 'CustomerController@caesar')->name('customer.caesar');
    Route::get('customer/vigenere', 'CustomerController@vigenere')->name('customer.vigenere');
    Route::post('customer/caesar', 'CustomerController@storeCaesar')->name('store.caesar');
    Route::post('customer/vigenere', 'CustomerController@storeVigenere')->name('store.vigenere');
    Route::resource('product', 'ProductController');
    Route::resource('project', 'ProjectController');
    Route::resource('order', 'OrderController');
    Route::resource('item', 'ItemController');
    Route::resource('progress', 'ProgressController');
    Route::resource('dashboard', 'DashboardController');

    Route::get('user/manageuser', 'UserController@index')->name('user.manageuser');
    Route::get('user/changepassword', 'UserController@showChangePassword')->name('user.changepassword');
    Route::post('user/changepassword', 'UserController@changePassword')->name('changePassword');
    Route::get('user/{user}/profile', 'UserController@profile')->name('user.profile');
    Route::patch('user/{user}/update', 'UserController@updateAsOperator')->name('user.updateAsOperator');
});
Route::resource('customer', 'CustomerController');
Route::resource('user', 'UserController');

Route::get('/test', 'DashboardController@test')->name('dashboard.test');
