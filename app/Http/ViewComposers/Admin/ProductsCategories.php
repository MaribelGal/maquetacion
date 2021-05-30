<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\ProductCategory;

class ProductsCategories
{

    static $composed;

    public function __construct(ProductCategory $products_categories)
    {
        $this->products_categories = $products_categories;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('products_categories', static::$composed);
        }

        static::$composed = $this->products_categories->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('products_categories', static::$composed);

    }
}