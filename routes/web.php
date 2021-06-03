<?php

use Illuminate\Support\Facades\Route;
use App\Vendor\Locale\LocalizationSeo;

$localizationseo = new LocalizationSeo();

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

    Route::get('/image/delete/{image?}', 'App\Vendor\Image\Image@destroy')->name('delete_image');
    Route::post('/image', 'App\Vendor\Image\Image@storeImageSeo')->name('store_image_seo');

    Route::resource('faqs_categorias', 'App\Http\Controllers\Admin\FaqCategoryController', [

        'names' => [
            'index' => 'faqs_categories',
            'create' => 'faqs_categories_create',
            'store' => 'faqs_categories_store',
            'destroy' => 'faqs_categories_destroy',
            'show' => 'faqs_categories_show',
        ]
    ]);


    Route::get('/faqs/filter/{filters?}', 'App\Http\Controllers\Admin\FaqController@filter')->name('faqs_filter');

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


    Route::get('/seo/sitemap', 'App\Http\Controllers\Admin\LocaleSeoController@getSitemaps')->name('create_sitemap');
    Route::get('/seo/import', 'App\Http\Controllers\Admin\LocaleSeoController@importSeo')->name('seo_import');
    Route::get('/seo/{key}', 'App\Http\Controllers\Admin\LocaleSeoController@edit')->name('seo_edit');
    Route::get('/seo', 'App\Http\Controllers\Admin\LocaleSeoController@index')->name('seo');
    Route::post('/seo', 'App\Http\Controllers\Admin\LocaleSeoController@store')->name('seo_store');
    Route::get('/ping-google', 'App\Http\Controllers\Admin\LocaleSeoController@pingGoogle')->name('ping_google');

    Route::get('/tags/filter/{filters?}', 'App\Http\Controllers\Admin\LocaleTagController@filter')->name('tags_filter');
    Route::get('/tags/groupKey/{groupKey?}', 'App\Http\Controllers\Admin\LocaleTagController@show')->name('tags_show');
    Route::get('/tags/import', 'App\Http\Controllers\Admin\LocaleTagController@importTags')->name('tags_import');
    Route::get('/tags', 'App\Http\Controllers\Admin\LocaleTagController@index')->name('tags');
    Route::post('/tags', 'App\Http\Controllers\Admin\LocaleTagController@store')->name('tags_store');

    Route::get('/shirts/filter/{filters?}', 'App\Http\Controllers\Admin\Management\Products\Shirt\ShirtController@filter')->name('shirts_filter');

    Route::resource('shirts', 'App\Http\Controllers\Admin\Management\Products\Shirt\ShirtController', [
        'names' => [
            'index' => 'shirts',
            'create' => 'shirts_create',
            'store' => 'shirts_store',
            'destroy' => 'shirts_destroy',
            'show' => 'shirts_show',
        ]
    ]);

    Route::post('/shirtsTissues', 'App\Http\Controllers\Admin\Management\Products\Shirt\ShirtTissueController@store')->name('shirtsTissues_store');

    
});

Route::group([
    'prefix' => $localizationseo->setLocale(),
    'middleware' => ['localize']
], function () use ($localizationseo) {

    Route::get($localizationseo->transRoute('routes.front_products'), 'App\Http\Controllers\Front\ProductController@index')->name('front_products');
    Route::get($localizationseo->transRoute('routes.front_product'), 'App\Http\Controllers\Front\ProductController@show')->name('front_product');


    Route::get($localizationseo->transRoute('routes.front_faqs'), 'App\Http\Controllers\Front\FaqController@index')->name('front_faqs');
    Route::get($localizationseo->transRoute('routes.front_faq'), 'App\Http\Controllers\Front\FaqController@show')->name('front_faq');
});

Route::post('/products/filterProductGroup', 'App\Http\Controllers\Front\ProductController@filterProductGroup')->name('filter_productGroup');

Route::post('/fingerprint', 'App\Http\Controllers\Front\FingerprintController@store')->name('front_fingerprint');


// FRONT
Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('front_login');

Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');

Route::get('/logout', 'App\Http\Controllers\Front\LoginController@logout')->name('front_logout');

// Route::get('/', 'App\Http\Controllers\Front\HomeController@index')->name('home_front');
// Route::get('/faqs', 'App\Http\Controllers\Front\FaqController@index')->name('faqs_front');
