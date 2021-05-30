<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\Shirt\ShirtTissue;

class ShirtsTissues
{

    static $composed;

    public function __construct(ShirtTissue $shirts_tissues)
    {
        $this->shirts_tissues = $shirts_tissues;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('shirts_tissues', static::$composed);
        }

        static::$composed = $this->shirts_tissues->where('active', 1)->get();

        $view->with('shirts_tissues', static::$composed);

    }
}

