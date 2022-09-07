<?php

use App\Http\Controllers\AuthController;
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

Route::group([
    'prefix' => 'auth',
], function() {

    Route::controller(AuthController::class)->group( function() {
        Route::post('login', 'login');

        Route::group([
            'middleware' => 'auth.jwt',
            'role:user'
        ], function( $router ) {
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
            Route::post('me', 'me');
        });
    });

});
