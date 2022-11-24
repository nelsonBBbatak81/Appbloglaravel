<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class AddCategory extends Component
{
    use WithFileUploads;
    public $title, $meta_info, $urlimage;
    public bool $isValid = false;

    protected $rules = [
        'title' => 'required|min:3',
        'meta_info' => 'required|min:5',
        'urlimage' => 'required|nullable|image|max:2048',
    ];

    public function render()
    {
        return view('livewire.category.add-category');
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

    public function back() {
        $this->emit('back-button');
    }

    public function store(){
        $this->validate();

        $image = $this->urlimage;
        $imagename = $this->title  . '-' . substr(uniqid(rand(), true), 8, 8) . '.' . $image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        $img->stream(); // <-- Key point
        Storage::disk('local')->put('public/images/category' . '/' . $imagename, $img, 'public');

        // create brand
        $category = Category::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'meta_info' => $this->meta_info,
            'urlimage' => $imagename,
        ]);

        $this->emit('store-category', $category->id);
    }


}
