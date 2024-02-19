<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'middleware' => ['auth.apikey']], function () {
    Route::post('/login', 'Auth@login');
    Route::post('/register', 'Auth@register');
    Route::post('/find-phone', 'Auth@findPhone');

    Route::post('forget-password', 'Auth@fogetPassword');

    Route::get('/promotions', 'Promotions@getPromotions');
    Route::get('/branches', 'Branches@getBranches');
    Route::get('/health-tips', 'HealthtTips@getHealthTips');
    Route::get('/health-tips/{healthTip}', 'HealthtTips@getDetail');
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', 'Profile@show');
    Route::post('/profile/update', 'Profile@update');
    Route::post('/profile/password', 'Profile@changePassword');
    Route::post('/logout', 'Auth@logout');



    Route::prefix('/appointments')->group(function () {
        Route::get('/', 'Appointment@lists');
        Route::post('/book', 'Appointment@book');
        Route::get('/date','Appointment@date');
        Route::get('/times', 'Appointment@times');
        Route::post('/cancel/{bookAnAppointment}', 'Appointment@cancel');
    });
});
