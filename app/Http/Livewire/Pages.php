<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Page;
use Illuminate\Validation\Rule;



class Pages extends Component
{
    use WithPagination;

    public $modalFormVisible = true;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules(){
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages','slug')->ignore(($this->modelId))],
            'content' => 'required',
        ];
    }
    
    /**
     * mount do when start livewire
     *
     * @return void
     */
    public function mount(){
        //reset pagination after reload this page
        $this->resetPage();
    }

    /**
     * Run everytime the title variable is updated
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedTitle($value)
    {
        $this->generateSlug($value);
    }

    public function create(){
        $this->validate();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    public function update(){
        $this->validate();
        Page::find($this->modelId)->update($this->modelData());
        $this->resetVars();
    }

    public function delete(){
        Page::destroy($this->modelId);
        $this->modelConfirmDeleteVisible = false;
        $this->resetPage();
    }


    /**
     * Show the form modal
     * of create function
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetVars();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id){
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }
        
    /**
     * Show the delete nodel confirmation
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    /**
     * load the model data
     * of this component
     *
     * @return void
     */
    public function loadModel(){
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
    }

    /**
     * The data for the model mapped
     * in this component
     *
     * @return void
     */
    public function modelData(){
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }

    /**
     * Reset all livewire variables to null
     *
     * @return void
     */
    public function resetVars(){
        $this->resetValidation();
        $this->modalFormVisible = false;
        $this->modelId = null;
        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }
    
    /**
     * The read function
     *
     * @return void
     */
    public function read(){
        return Page::paginate(5);
    }

    private function generateSlug($value){
        $process1 = str_replace(' ','-',$value);
        $process2 = strtolower($value);
        $this->slug = $process2;
    }

    /**
     *The livewire render function     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }
}
