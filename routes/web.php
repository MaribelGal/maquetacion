<?php

use Illuminate\Support\Facades\Route;

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


// Route::get('/faqs', function () {
//     return view('/admin/faqs/index');
// });






Route::group(['prefix' => 'admin'], function () {
    // Route::get('/faqs/json', 'App\Http\Controllers\Admin\FaqController@indexJson')->name('faqs_json');

    Route::resource('faqs_categorias', 'App\Http\Controllers\Admin\FaqCategoryController', [

        'names' => [
            'index' => 'faqs_categories',
            'create' => 'faqs_categories_create',
            'store' => 'faqs_categories_store',
            'destroy' => 'faqs_categories_destroy',
            'show' => 'faqs_categories_show',
        ]
    ]);

    Route::post('/faqs/filter', 'App\Http\Controllers\Admin\FaqController@filter')->name('faqs_filter');
    
    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
        'names' => [
            'index' => 'faqs', //Llamada de tipo get. Muestra todo
            'create' => 'faqs_create',
            'store' => 'faqs_store', //Llamada de tipo post. Edita y guarda
            'destroy' => 'faqs_destroy', //Llamada de tipo delete.
            'show' => 'faqs_show', //Muestra una cosa
        ]
    ]);

    Route::resource('users', 'App\Http\Controllers\Admin\UserController', [
        'names' => [
            'index' => 'users', //Llamada de tipo get. Muestra todo
            'create' => 'users_create',
            'store' => 'users_store', //Llamada de tipo post. Edita y guarda
            'destroy' => 'users_destroy', //Llamada de tipo delete.
            'show' => 'users_show', //Muestra una cosa
        ]
    ]);

    //---------------------------------------------------------------------------
    // 14.04.2021 - Examen
    Route::resource('clientes', 'App\Http\Controllers\Admin\ClienteController', [
        //NOTA: el singular por defecto será {cliente}, es correcto no lo modifico
        'names' => [
            'index' => 'clientes',
            'create' => 'clientes_create',
            'store' => 'clientes_store',
            'destroy' => 'clientes_destroy',
            'show' => 'clientes_show',
        ]
    ]);

    //---------------------------------------------------------------------------
    Route::post('/sliders/filter', 'App\Http\Controllers\Admin\SliderController@filter')->name('sliders_filter');
    
    Route::resource('sliders', 'App\Http\Controllers\Admin\SliderController', [
        'names' => [
            'index' => 'sliders',
            'create' => 'sliders_create',
            'store' => 'sliders_store',
            'destroy' => 'sliders_destroy',
            'show' => 'sliders_show',
        ]
    ]);

});

Route::post('/fingerprint', 'App\Http\Controllers\Front\FingerprintController@store')->name('front_fingerprint');


// FRONT
Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('front_login');

Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');

Route::get('/logout', 'App\Http\Controllers\Front\LoginController@logout')->name('front_logout');

// Route::get('/', 'App\Http\Controllers\Front\HomeController@index')->name('home_front');
Route::get('/faqs', 'App\Http\Controllers\Front\FaqController@index')->name('faqs_front');
