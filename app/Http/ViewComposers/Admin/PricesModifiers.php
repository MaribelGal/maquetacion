<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Management\PriceModifier;

class PricesModifiers
{

    static $composed;

    public function __construct(PriceModifier $prices_modifiers)
    {
        $this->prices_modifiers = $prices_modifiers;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('prices_modifiers', static::$composed);
        }

        static::$composed = $this->prices_modifiers->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('prices_modifiers', static::$composed);

    }
}