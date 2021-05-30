<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\Color;

class Colors
{

    static $composed;

    public function __construct(Color $colors)
    {
        $this->colors = $colors;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('colors', static::$composed);
        }

        static::$composed = $this->colors->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('colors', static::$composed);

    }
}