<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    public $category, $idcategory, $titlemodal, $descriptionmodal;
    public bool $listmode = true;
    public bool $addmode = false;
    public bool $editmode = false;
    public bool $showmode = false;
    public bool $modalmode = false;

    protected $listeners = [
        'show-form-add' => 'handleShowFormAdd',
        'back-button' => 'handleBackButton',
        'store-category' => 'handleStoreCategory',
        'show-form-update-category' => 'handleShowFormUpdateCategory',
        'update-category' => 'handleUpdateCategory',
        'show-data-category' => 'handleShowDataCategory',
        'show-modal-delete-category' => 'handleShowModalDeleteCategory',
        'close-modal-delete' => 'handleCloseModalDeleteCategory',
        'delete-item'=> 'handleDeleteCategory',
    ];

    public function render()
    {
        return view('livewire.category.index');
    }

    public function handleBackButton() {
        $this->addmode = false;
        $this->listmode = true;
    }

    public function handleShowFormAdd() {
        $this->listmode = false;
        $this->addmode = true;
    }

    public function handleStoreCategory($id) {
        $this->addmode = false;
        $this->listmode = true;

        $this->dispatchBrowserEvent('swal:modal', [

            'type' => 'success',

            'message' => 'Category with id ' . $id . ' successfully created!.',

        ]);
    }

    public function handleShowFormUpdateCategory($category) {
        $this->category = $category;
        $this->listmode = false;
        $this->editmode = true;
    }

    public function handleUpdateCategory($id) {
        $this->editmode = false;
        $this->category = null;
        $this->listmode = true;

        $this->dispatchBrowserEvent('swal:modal', [

            'type' => 'success',

            'message' => 'Category with id ' . $id . ' successfully updated!.',

        ]);
    }

    public function handleShowDataCategory($category) {
        $this->category = $category;
        $this->listmode = false;
        $this->showmode = true;
    }

    public function handleShowModalDeleteCategory($id) {
        $this->titlemodal = "Delete Category";
        $this->descriptionmodal = "Are you sure want to delete this category with id " . $id . "?";
        $this->modalmode = true;
        $this->idcategory = $id;
    }

    public function handleCloseModalDeleteCategory() {
        $this->modalmode = false;
    }

    public function handleDeleteCategory() {
        $categorydelete = Category::find($this->idcategory);
        File::delete(storage_path('app/public/images/category/' . $categorydelete->urlimage));
        // dd(storage_path('app/public/images/category' . $category->urlimage));
        $categorydelete->delete();
        $this->modalmode = false;

        $this->dispatchBrowserEvent('swal:modal', [

            'type' => 'success',

            'message' => 'Category with id ' . $this->idcategory . ' successfully deleted!.',

        ]);
    }
}
