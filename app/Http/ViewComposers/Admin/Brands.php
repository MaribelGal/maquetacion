<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Brand;

class Brands
{

    static $composed;

    public function __construct(Brand $brands)
    {
        $this->brands = $brands;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('brands', static::$composed);
        }

        static::$composed = $this->brands->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('brands', static::$composed);

    }
}