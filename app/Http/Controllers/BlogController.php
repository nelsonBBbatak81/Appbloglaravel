<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index() {
        return view('admin.blog.list-blog');
    }

    public function addBlog() {
        return view('admin.blog.add-blog');
    }

    public function showBlog($id) {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.show-blog', ['blog' => $blog]);
    }

    public function editBlog($id) {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit-blog', ['blog' => $blog]);
    }
}
