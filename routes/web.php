<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::group(['prefix' => 'goods-category','middleware'=>'auth'],function (){
    Route::view('','goods-category')->name('goods-category');
});
Route::group(['prefix' => 'goods','middleware'=>'auth'],function (){
    Route::view('','goods')->name('goods');
});
Route::group(['prefix' => 'transaction','middleware'=>'auth'],function (){
    Route::view('','transaction')->name('transaction');
});;
Route::group(['prefix' => 'third_party_account','middleware'=>'auth'],function (){
    Route::view('','third_party_account')->name('third_party_account');
});

require __DIR__.'/auth.php';
