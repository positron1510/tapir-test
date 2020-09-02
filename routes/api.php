<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;

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


Route::prefix('v1/advertisement')->group(function () {
    Route::get('', 'AdvertisementController@all')->name('api.all');
    Route::post('', 'AdvertisementController@store')->name('api.store');
    Route::get('get', 'AdvertisementController@single')->name('api.single');
});
