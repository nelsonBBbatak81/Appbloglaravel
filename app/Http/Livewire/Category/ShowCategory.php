<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;

class ShowCategory extends Component
{
    public $idcategory, $title, $slug, $meta_info, $urlimage, $image;

    public function mount($category) {
        $this->idcategory = $category['id'];
        $this->title = $category['title'];
        $this->slug = $category['slug'];
        $this->meta_info= $category['meta_info'];
        $this->image = $category['urlimage'];
    }

    public function render()
    {
        return view('livewire.category.show-category');
    }

    public function back() {
        $this->emit('back-button');
    }
}
