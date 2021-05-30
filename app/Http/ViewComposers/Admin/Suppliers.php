<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Supplier;

class Suppliers {

    static $composed;

    public function __construct(Supplier $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('suppliers', static::$composed);
        }

        static::$composed = $this->suppliers->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('suppliers', static::$composed);

    }
}