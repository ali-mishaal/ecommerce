<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{

    public $modal_id;
    public $title;
    public $form_id;
    public $save_text;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalId, $title = 'test title', $formId = null, $saveText = null)
    {
        $this->modal_id = $modalId;
        $this->title = $title;
        $this->form_id = $formId;
        $this->save_text = $saveText ?? trans('lang.save');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.modal');
    }
}
