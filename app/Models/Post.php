<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'tag_id',
        'title',
        'short_description',
        'detailed_description',
        'slug',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'featured_image',
        'is_draft',
        'is_published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function images()
    {
        return $this->hasMany(PostGalleryImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function previousPost(){
        return  Post::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }

    public function nextPost(){
        return Post::where('id', '>', $this->id)->orderBy('id')->first();
    }

    public function scopePublished($query)
    {
    return $query->where('is_published', true);
    }
}
