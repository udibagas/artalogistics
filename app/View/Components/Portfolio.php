<?php

namespace App\View\Components;

use App\Portfolio as AppPortfolio;
use Illuminate\View\Component;

class Portfolio extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.portfolio', ['portfolios' => AppPortfolio::all()]);
    }
}
