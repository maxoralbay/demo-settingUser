<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/', function () {
    return response()->json(['message' => 'server is running']);
});

Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
Route::post('/refresh', 'App\Http\Controllers\AuthController@refresh');

// UserSetting get and update
Route::get('/user/get/setting', 'App\Http\Controllers\Api\UserSettingController@getSettingByKey')->name('user.setting.get');
Route::post('/user/updateOrCreate/setting/{userId}', 'App\Http\Controllers\Api\UserSettingController@updateSetting')->name('user.setting.update');
Route::post('/user/send/notification', 'App\Http\Controllers\Api\UserSettingController@sendNotification')->name('user.notification.send');
