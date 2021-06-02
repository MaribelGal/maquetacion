<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\Size;

class Sizes
{

    static $composed;

    public function __construct(Size $sizes)
    {
        $this->sizes = $sizes;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('sizes', static::$composed);
        }

        static::$composed = $this->sizes->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('sizes', static::$composed);

    }
}