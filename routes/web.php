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


Route::get('/faqs', 'App\Http\Controllers\Front\FaqController@index');

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
    
    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
        'names' => [
            'index' => 'faqs', //Llamada de tipo get. Muestra todo
            'create' => 'faqs_create',
            'store' => 'faqs_store', //Llamada de tipo post. Edita y guarda
            'destroy' => 'faqs_destroy', //Llamada de tipo delete.
            'show' => 'faqs_show', //Muestra una cosa
        ]
    ]);
}); 





