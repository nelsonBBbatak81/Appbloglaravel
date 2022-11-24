<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class EditCategory extends Component
{
    use WithFileUploads;
    public $idcategory, $title, $meta_info, $urlimage, $image;
    public bool $isValid = false;

    protected $rules = [
        'title' => 'required|min:3',
        'meta_info' => 'required|min:5',
    ];

    public function mount($category) {
        $this->idcategory = $category['id'];
        $this->title = $category['title'];
        $this->meta_info= $category['meta_info'];
        $this->image = $category['urlimage'];
    }

    public function updated() {
        if(!is_null($this->title) && !empty($this->title) &&
        !is_null($this->meta_info) && !empty($this->meta_info) &&
        !is_null($this->urlimage) && !empty($this->urlimage)) {
            $this->isValid = true;
        } else {
            $this->isValid = false;
        }
    }

    public function render()
    {
        return view('livewire.category.edit-category');
    }

    public function back() {
        $this->emit('back-button');
    }

    public function update()
    {
        $this->validate();

        $categoryupdateitem = Category::find($this->idcategory);
        $categoryupdateitem->title = $this->title;
        $categoryupdateitem->slug = Str::slug($this->title);
        $categoryupdateitem->meta_info = $this->meta_info;
        if ($this->urlimage !== null) {
            File::delete(storage_path('app/public/images/category/' . $categoryupdateitem->urlimage));
            $image          = $this->urlimage ;
            $imageName      = $image->getClientOriginalName();
            $imageNewName   = explode('.', $imageName)[0];
            $fileExtention  = time() . '.' . $imageNewName . '.' . $image->getClientOriginalExtension();
            $location       = $this->urlimage->storeAs('/public/images/category', $fileExtention);
            $categoryupdateitem->urlimage = $fileExtention;
        }
        $categoryupdateitem->update();
        $this->emit('update-category', $categoryupdateitem->id);
    }
}
