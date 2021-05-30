<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\Shirt\ShirtSleeve;

class ShirtsSleeves
{

    static $composed;

    public function __construct(ShirtSleeve $shirts_sleeves)
    {
        $this->shirts_sleeves = $shirts_sleeves;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('shirts_sleeves', static::$composed);
        }

        static::$composed = $this->shirts_sleeves->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('shirts_sleeves', static::$composed);

    }
}

