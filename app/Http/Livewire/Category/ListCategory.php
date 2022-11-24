<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class ListCategory extends Component
{
    public function render()
    {
        return view('livewire.category.list-category', [
            'categories' => Category::orderBy("created_at", "desc")->paginate(2),
        ]);
    }

    public function showFormAddCategory() {
        $this->emit('show-form-add');
    }

    public function showCategory($category) {
        $this->emit('show-data-category', $category);
    }

    public function updateCategory($category) {
        $this->emit('show-form-update-category', $category);
    }

    public function deleteCategory($id) {
        $this->emit('show-modal-delete-category', $id);
    }

}
