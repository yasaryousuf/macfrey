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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@homepage');


Route::get('/test', 'HomeController@test');

Route::resource('news', 'NewsController');



Route::get('service', 'ServiceController@index');
Route::get('service/{slug}', 'ServiceController@show');
Route::put('service/{id}', 'ServiceController@update')->name('service.update');
Route::post('service', 'ServiceController@store');
Route::delete('service/{id}', 'ServiceController@destroy')->name('service.destroy');


Route::get('company', 'CompanyController@index');
Route::get('company/{slug}', 'CompanyController@show');
Route::put('company/{id}', 'CompanyController@update')->name('company.update');
Route::post('company', 'CompanyController@store');
Route::delete('company/{id}', 'CompanyController@destroy')->name('company.destroy');

Route::post('component_category', 'ComponentCategoryController@store');
Route::put('component_category/{id}', 'ComponentCategoryController@update')->name('component_category.update');
Route::delete('component_category/{id}', 'ComponentCategoryController@destroy')->name('component_category.destroy');

Route::delete('component/{id}', 'ComponentController@destroy')->name('component.destroy');

Route::get('component/{subcategory}', 'ComponentController@index');
Route::get('component/{subcategory}/{component}', 'ComponentController@show');
Route::post('component', 'ComponentController@store');
Route::post('component/update', 'ComponentController@update')->name('component.update');

Route::post('drive_system_category', 'DriveSystemCategoryController@store');
Route::put('drive_system_category/{id}', 'DriveSystemCategoryController@update')->name('drive_system_category.update');
Route::delete('drive_system_category/{id}', 'DriveSystemCategoryController@destroy')->name('drive_system_category.destroy');

Route::get('drive_system', 'DriveSystemController@index');
Route::get('drive_system/{category}/{slug}', 'DriveSystemController@show');
Route::post('drive_system', 'DriveSystemController@store');
Route::put('drive_system/{id}', 'DriveSystemController@update')->name('drive_system.update');
Route::delete('drive_system/{id}', 'DriveSystemController@destroy')->name('drive_system.destroy');


Route::post('contact', 'ContactController@store');

Route::put('slider/{id}', 'SliderController@update')->name('slider.update');
Route::post('slider', 'SliderController@store');
Route::delete('slider/{id}', 'SliderController@destroy')->name('slider.destroy');

Route::middleware(['auth'])->group(function () {

    Route::post('/admin/profile', 'AdminController@saveProfile');
    Route::get('/admin/profile/edit', 'AdminController@showEditProfilePage');
    Route::get('/admin/profile/change-password', 'AdminController@showEditPasswordPage');
    Route::post('/admin/profile/change-password', 'AdminController@saveChangePassword');

    Route::get('/admin/home', 'AdminController@index');


    Route::get('admin/news', 'NewsController@adminIndex');
    Route::get('admin/news/create', 'NewsController@create');
    Route::get('admin/news/{id}/edit', 'NewsController@edit');

    Route::get('admin/service', 'ServiceController@adminIndex');
    Route::get('admin/service/create', 'ServiceController@create');
    Route::get('admin/service/{id}/edit', 'ServiceController@edit');

    Route::get('admin/company', 'CompanyController@adminIndex');
    Route::get('admin/company/create', 'CompanyController@create');
    Route::get('admin/company/{id}/edit', 'CompanyController@edit');

    Route::get('admin/contact', 'ContactController@adminIndex');
    Route::get('admin/enquiry', 'ContactController@enquiry');

    Route::get('admin/component_category', 'ComponentCategoryController@adminIndex');
    Route::get('admin/component_category/create', 'ComponentCategoryController@create');
    Route::get('admin/component_category/{id}/edit', 'ComponentCategoryController@edit');

    Route::get('admin/component', 'ComponentController@adminIndex');
    Route::get('admin/component/create', 'ComponentController@create');
    Route::get('admin/component/{id}/edit', 'ComponentController@edit');

    Route::get('admin/drive_system_category', 'DriveSystemCategoryController@adminIndex');
    Route::get('admin/drive_system_category/create', 'DriveSystemCategoryController@create');
    Route::get('admin/drive_system_category/{id}/edit', 'DriveSystemCategoryController@edit');

    Route::get('admin/drive_system', 'DriveSystemController@adminIndex');
    Route::get('admin/drive_system/create', 'DriveSystemController@create');
    Route::get('admin/drive_system/{id}/edit', 'DriveSystemController@edit');

    Route::get('admin/slider', 'SliderController@adminIndex');
    Route::get('admin/slider/create', 'SliderController@create');
    Route::get('admin/slider/{id}/edit', 'SliderController@edit');

});