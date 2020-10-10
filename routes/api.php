<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function(){
    // Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    // Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');

});

Route::middleware('auth:api')->group(function(){
    // Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
    Route::get('/articles', [ArticleController::class, 'index'])->middleware('api.admin')->name('articles');
});
