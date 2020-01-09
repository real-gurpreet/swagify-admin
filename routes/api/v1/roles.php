<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'roles',
    'middleware' => 'jwt',

], function () {
    Route::get('/{id}', 'API\RolesController@edit');
    Route::put('/', 'API\RolesController@update');
    Route::delete('/', 'API\RolesController@destroy');
    Route::get('/', 'API\RolesController@index');
    Route::post('/', 'API\RolesController@store');
});

Route::group([
    'prefix' => 'permissions',
    'middleware' => 'jwt'
], function () {
    Route::get('/{id}', 'API\PermissionsController@edit');
    Route::put('/', 'API\PermissionsController@update');
    Route::delete('/', 'API\PermissionsController@destroy');
    Route::get('/', 'API\PermissionsController@index');
    Route::post('/', 'API\PermissionsController@store');
    Route::post('/assigntorole', 'API\PermissionsController@assignPermissionToRole');
    Route::post('/multitorole', 'API\PermissionsController@assignMultiplePermissionToRole');
    Route::post('/revokepermission', 'API\PermissionsController@revokePermissionToRole');
    Route::post('/revokemultipermssion', 'API\PermissionsController@revokeMultiplePermissionToRole');
});
