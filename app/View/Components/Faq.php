<?php

namespace App\View\Components;

use App\Faq as AppFaq;
use Illuminate\View\Component;

class Faq extends Component
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
        return view('components.faq', ['faqs' => AppFaq::all()]);
    }
}
