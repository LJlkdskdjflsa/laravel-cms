<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pages extends Component
{

    public $slug;
    public $title;
    public $content;
    
    /**
     * Show the form modal
     * of create function
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->modalFormVisible = true;
    }
    
    /**
     *The livewire render function     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages');
    }
}