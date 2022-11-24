<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;
use App\Models\Tag;

class ShowBlog extends Component
{
    public $idblog, $title, $subtitle, $category, $slug, $meta_info, $content, $tags, $urlimage, $blogimages;

    public function mount($blog) {
        $this->idblog = $blog['id'];
        $this->title = $blog['title'];
        $this->subtitle = $blog['subtitle'];
        $this->category = $blog->category->title;
        $this->slug = $blog['slug'];
        $this->meta_info = $blog['meta_info'];
        $this->content = $blog['content'];
        $taglistId = $blog->taggings()->pluck('tag_id');
        $arr = [];
        foreach($taglistId as $id) {
            $tag = Tag::findOrFail($id);
            array_push($arr, $tag->title);
        }
        $this->tags = $arr;
        $this->urlimage = $blog['urlimage'];
        $this->blogimages = $blog->blog_images()->pluck('urlimage');
    }

    public function render()
    {

        return view('livewire.blog.show-blog');
    }
}
