<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\Shirt\ShirtPattern;

class ShirtsPatterns
{

    static $composed;

    public function __construct(ShirtPattern $shirts_patterns)
    {
        $this->shirts_patterns = $shirts_patterns;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('shirts_patterns', static::$composed);
        }

        static::$composed = $this->shirts_patterns->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('shirts_patterns', static::$composed);

    }
}
