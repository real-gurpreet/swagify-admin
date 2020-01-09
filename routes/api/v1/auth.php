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
| is assigned the "API" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:API')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group([
//     'prefix' => 'auth',
// ], function () {
//     Route::post('login', 'API\AuthController@login');
//     Route::post('signup', 'API\AuthController@signup');

//     Route::group([
//         'middleware' => 'auth:API',
//     ], function () {
//         Route::get('logout', 'API\AuthController@logout');
//         Route::get('user', 'API\AuthController@user');
//     });
// });

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('signup', 'API\AuthController@signup');
    Route::post('login', 'API\AuthController@login');
});

Route::group([
    'prefix' => 'auth',
    'middleware' => 'jwt'
], function () {
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::get('me', 'API\AuthController@me');
    Route::post('/assign_roles', 'API\AuthController@assignUserRoles');
    Route::post('/check_permission', 'API\AuthController@checkPermission');


    // Route::put('/{id}', 'API\PermissionsController@update');
    // Route::delete('/{id}', 'API\PermissionsController@destroy');
    // Route::get('/', 'API\PermissionsController@index');




});
