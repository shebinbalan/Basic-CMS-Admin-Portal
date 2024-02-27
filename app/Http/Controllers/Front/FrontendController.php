<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostGalleryImage;

class FrontendController extends Controller
{
    public function index(){
       
        $posts = Post::all();
        $categories = Category::all();
        $featured = Post::where('is_published', false)->take(3)->get();
     
        return view('front.index', [
            'posts' => $posts,
            'categories' => $categories,
            'featured'=>$featured
        ]);
        return view('front.index');
    }

    public function posts(){
        return view('front.posts.index');
    }


    public function showPost(Post $post){
        $post = $post->load('user','categories');
        $categories = Category::all();
        return view('front.posts.show', compact('post', 'categories'));
    }

    public function showCategory(Category $category){
        $post = $category->posts()->get();
        $categories = Category::all();
        return view('front.categories.show', compact('category', 'post', 'categories'));
    }
}
