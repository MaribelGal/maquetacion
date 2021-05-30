<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\Shirt\ShirtNeck;

class ShirtsNecks
{

    static $composed;

    public function __construct(ShirtNeck $shirts_necks)
    {
        $this->shirts_necks = $shirts_necks;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('shirts_necks', static::$composed);
        }

        static::$composed = $this->shirts_necks->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('shirts_necks', static::$composed);

    }
}

