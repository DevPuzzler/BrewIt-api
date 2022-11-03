<?php

use App\Enums\UserRolesEnum as UserRoles;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrewCategoryController;
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

Route::controller(AuthController::class)
    ->prefix('auth')
    ->group( function() {
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

Route::controller(BrewCategoryController::class)
    ->prefix('brewcategories')
    ->middleware([
        'auth.jwt',
        sprintf('role:%s', UserRoles::USER->value)
    ])
    ->group( function() {
        Route::post('', 'create');
    });
