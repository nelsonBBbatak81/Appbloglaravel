<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;
use App\Models\Blog;
use Illuminate\Support\Facades\File;

class ListBlog extends Component
{
    public function render()
    {
        return view('livewire.blog.list-blog', [
            'blogs' => Blog::orderBy("created_at", "desc")->paginate(2),
        ]);
    }

    public function showFormAddBlog() {
        $this->emit('show-form-add-blog');
    }

    public function showBlog($blog) {}

    public function updateBlog($blog) {}

    public function deleteBlog($idblog) {
        $blog = Blog::find($idblog);
        // dd(storage_path('app/public/images/blog/' . $blog->urlimage));
        File::delete(storage_path('app/public/images/blog/' . $blog->urlimage));
        foreach($blog->blog_images->pluck('urlimage') as $item => $value) {
            // File::delete($value);
            // dd($value);
            // dd(strrchr( $value, 'uploads/'));
            File::delete(storage_path('app/public/' . strrchr( $value, 'uploads/')));
        }
        $blog->delete();

        $this->dispatchBrowserEvent('swal:modal', [

            'type' => 'success',

            'message' => 'Blog with id ' . $blog->id . ' successfully deleted!.',

        ]);
    }
}
