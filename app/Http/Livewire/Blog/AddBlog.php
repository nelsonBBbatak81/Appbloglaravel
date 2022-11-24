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

class AddBlog extends Component
{
    use WithFileUploads;
    public $title, $subtitle, $category_id, $content, $meta_info, $urlimage, $tags;
    public bool $isValid = false;


    protected $rules = [
        'title' => 'required|min:3',
        'subtitle' => 'required|min:3',
        'category_id' => 'required',
        'content' => 'required|min:5',
        'meta_info' => 'required|min:5',
        'urlimage' => 'required|nullable|image|max:2048',
    ];


    public function render()
    {
        return view('livewire.blog.add-blog', [
            'categories' => Category::all()
        ]);
    }

    public function updated() {
        if(!is_null($this->title) && !empty($this->title) &&
        !is_null($this->subtitle) && !empty($this->subtitle) &&
        !is_null($this->category_id) && !empty($this->category_id) &&
        !is_null($this->meta_info) && !empty($this->meta_info) &&
        !is_null($this->content) && !empty($this->content) &&
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
        // $data = [
        //         'title' => $this->title,
        //     'subtitle' => $this->subtitle,
        //     'slug' => Str::slug($this->title),
        //     'category_id' => $this->category_id,
        //     'content' => $this->content,
        //     'meta_info' => $this->meta_info,
        //     'urlimage' => $this->urlimage,
        //     'tags' => $this->tags,
        // ];
        // dd($this->tags);
        $doc = new \DOMDocument();
        $doc->loadHTML($this->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $xpath = new \DOMXPath($doc);

        $blogImageSrcs = [];
        foreach ($xpath->query("//img[@src]") as $item) {
            $blogImageSrcs[] = $item->getAttribute('src');
        }
        // dd($blogImageSrcs);

        $image = $this->urlimage;
        $imagename = $this->title  . '-' . substr(uniqid(rand(), true), 8, 8) . '.' . $image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath())->encode('jpg', 65)->fit(760, null, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        $img->stream(); // <-- Key point
        Storage::disk('local')->put('public/images/blog' . '/' . $imagename, $img, 'public');

        // create brand
        $blog = Blog::create([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'category_id' => $this->category_id,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'meta_info' => $this->meta_info,
            'urlimage' => $imagename,
        ]);

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

        foreach($blogImageSrcs as $item => $value) {
            $blogimages = new BlogImage();
            $blogimages->blog_id = $blog->id;
            $blogimages->urlimage = $value;
            $blogimages->save();
        }

        $this->dispatchBrowserEvent('swal:modal', [

            'type' => 'success',

            'message' => 'Blog successfully saved!.',

        ]);

        return redirect('/blogs');
    }


}
