<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostGalleryImages extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'gallery_images'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
