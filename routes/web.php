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
    return 'Hello world';
});

Route::get('/signup', [\App\Http\Controllers\AuthController::class, 'signupPage'])->name('signup');
Route::post('/signup', [\App\Http\Controllers\AuthController::class, 'signup']);
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::get('/logout', function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');
}) -> middleware('auth') -> name('logout');

Route::get('/account', function (){
    return view('account');
}) -> middleware(['auth']) -> name('account');

