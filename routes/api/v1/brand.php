<?php
/**
 * api routes for brand , category and subcategory
 * version: 1.0
 */
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'brand',
    'middleware' => 'jwt',
], function () {
    Route::post('/', 'API\BrandController@store');
    Route::get('/', 'API\BrandController@index');
    Route::get('/{id}', 'API\BrandController@edit');
    Route::put('/', 'API\BrandController@update');
    Route::delete('/', 'API\BrandController@destroy');
});
