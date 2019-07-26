<?php

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



Route::get('/', 'DashboardController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function() {
    Route::resource('clients', 'ClientsController');
    Route::resource('dashboard', 'DashboardController');
    Route::resource('settings', 'SettingsController');
    Route::resource('invoices', 'InvoicesController');
    Route::resource('products', 'ProductsController');

    Route::get('dashboard', 'DashboardController@index');
    Route::get('clients', 'ClientsController@index');
    Route::get('invoices', 'InvoicesController@index');
    Route::get('products', 'ProductsController@index');

    Route::post('settings/update-company', 'SettingsController@update_company');
    Route::post('settings/add-accounts', 'SettingsController@add_accounts');
    Route::post('settings/add-docs', 'SettingsController@add_documents');
    Route::post('settings/add-vat', 'SettingsController@add_vat');
    Route::post('products/addimages', 'ProductsController@add_images');
    Route::post('product/image/delete', 'ProductsController@delete_images');

    Route::post('settings/update-account', 'AjaxRequestController@update_account');
    Route::post('settings/update-default-doc', 'AjaxRequestController@update_default_doc');
    Route::post('settings/update-config-default-vat', 'AjaxRequestController@update_config_default_vat');
    Route::post('get-client-details', 'AjaxRequestController@get_client_details');
    Route::post('delete-image-product', 'AjaxRequestController@delete_image_product');
    Route::post('set-default-image-product', 'AjaxRequestController@set_default_image_product');
    Route::post('get-client-details', 'AjaxRequestController@get_client');
    Route::post('get-product-details', 'AjaxRequestController@get_product_details');

});