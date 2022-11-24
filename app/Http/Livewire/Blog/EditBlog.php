<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Tagging;
use App\Models\Category;
use App\Models\BlogImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EditBlog extends Component
{
    use WithFileUploads;
    public $idBlog, $title, $subtitle, $category_id, $categoryTitle, $content, $meta_info, $urlimage, $image, $tags;

    public function mount($blog) {
        $this->idBlog = $blog['id'];
        $this->title = $blog['title'];
        $this->subtitle = $blog['subtitle'];
        $this->category_id = $blog['category_id'];
        $this->categoryTitle = $blog->category->title;
        $this->content = $blog['content'];
        $this->meta_info = $blog['meta_info'];
        $this->image = $blog['urlimage'];
        $taglistId = $blog->taggings()->pluck('tag_id');
        $arr = [];
        foreach($taglistId as $id) {
            $tag = Tag::findOrFail($id);
            array_push($arr, $tag->title);
        }
        $this->tags = $arr;
    }

    public function render()
    {
        return view('livewire.blog.edit-blog', [
            'categories' => Category::all()
        ]);
    }

    public function update() {
        $blog = Blog::find($this->idBlog);
        $blog->title = $this->title;
        $blog->subtitle = $this->subtitle;
        $blog->category_id = $this->category_id;
        $blog->slug = Str::slug($this->title);
        $blog->meta_info = $this->meta_info;


        $doc = new \DOMDocument();
        $doc->loadHTML($this->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $xpath = new \DOMXPath($doc);

        $blogImageSrcs = [];

        foreach ($xpath->query("//img[@src]") as $item) {
            $blogImageSrcs[] = $item->getAttribute('src');
        }
        foreach($blog->blog_images->pluck('urlimage') as $item => $valueitem) {
            $checkurlimage = false;
            foreach($blogImageSrcs as $item => $value) {
                if($valueitem === $value) {
                    $checkurlimage = true;
                    break;
                } else {
                    $checkurlimage = false;
                }
            }
            if(!$checkurlimage) {
                File::delete(storage_path('app/public/' . strrchr( $valueitem, 'uploads/')));
                BlogImage::where('blog_id', $blog->id)->where('urlimage', $valueitem)->delete();
            }
        }
        foreach($blogImageSrcs as $item => $value) {
            $blogImage = DB::table('blog_images')->where('blog_id', $blog->id)->where('urlimage', $value)->first();
            if(!isset($blogImage)) {
                $blogimages = new BlogImage();
                $blogimages->blog_id = $blog->id;
                $blogimages->urlimage = $value;
                $blogimages->save();
            }
        }

        $blog->content = $this->content;
        if ($this->urlimage !== null) {
            File::delete(storage_path('app/public/images/blog/' . $blog->urlimage));
            $image = $this->urlimage;
            $imagename = $this->title  . '-' . substr(uniqid(rand(), true), 8, 8) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/blog' . '/' . $imagename, $img, 'public');
            $blog->urlimage = $imagename;
        }


        Tagging::where('blog_id', $blog->id)->delete();
        foreach($this->tags as $tag => $value) {
            $tag = DB::table('tags')->where('title', $value)->first();
            // dd($tag);
            if(isset($tag)) {
                $tagging = new Tagging();
                $tagging->tag_id = $tag->id;
                $tagging->blog_id = $blog->id;
                $tagging->save();
            } else {
                $tagnew = new Tag();
                $tagging = new Tagging();
                $tagnew->title = $value;
                $tagnew->slug = Str::slug($value);
                $tagnew->save();
                $tagging->tag_id = $tagnew->id;
                $tagging->blog_id = $blog->id;
                $tagging->save();
            }
        }

        $blog->update();

        $this->dispatchBrowserEvent('swal:modal', [

            'type' => 'success',

            'message' => 'Blog successfully saved!.',

        ]);

        return redirect('/blogs');
    }
}
