<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\Shirt\ShirtSize;

class ShirtsSizes
{

    static $composed;

    public function __construct(ShirtSize $shirts_sizes)
    {
        $this->shirts_sizes = $shirts_sizes;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('shirts_sizes', static::$composed);
        }

        static::$composed = $this->shirts_sizes->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('shirts_sizes', static::$composed);

    }
}