<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = ["title", "slug", "meta_info", "urlimage"];

    public function blogs() {
        return $this->hasMany(Blog::class, 'blog_id');
    }
}
