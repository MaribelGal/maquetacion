<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\Tissue;

class Tissues
{

    static $composed;

    public function __construct(Tissue $tissues)
    {
        $this->tissues = $tissues;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('tissues', static::$composed);
        }

        static::$composed = $this->tissues->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('tissues', static::$composed);

    }
}

