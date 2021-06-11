<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\Products\ModelTissue;

class ModelsTissues
{

    static $composed;

    public function __construct(ModelTissue $models_tissues)
    {
        $this->models_tissues = $models_tissues;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('models_tissues', static::$composed);
        }

        static::$composed = $this->models_tissues->where('active', 1)->get();

        $view->with('models_tissues', static::$composed);

    }
}

