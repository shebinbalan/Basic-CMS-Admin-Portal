<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostGalleryImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('tag')->get();
        return view('admin.posts.index', compact('posts'));
    }
    public function add()
    {
        $category =Category::all();
        $tags =Tag::all();
        return view('admin.posts.add',compact('category','tags'));
    }

    public function insert(Request $request)
    {    
        // Validate the request
        $validator = Validator::make($request->all(), [
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id',
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'detailed_description' => 'required|string',
            'slug' => 'required|string|unique:posts,slug',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'is_draft' => 'required',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Create a new post instance
        $post = new Post();
    
        // Upload featured image if provided
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/featured_image', $filename);
            $post->featured_image = $filename;
        }
    
        // Set user ID
        $user_id = auth()->id();
        $post->user_id = $user_id;
    
        // Assign other attributes
        $post->category_id = $request->input('category_id');
        $post->tag_id = $request->input('tag_id');
        $post->title = $request->input('title');
        $post->short_description = $request->input('short_description');
        $post->detailed_description = $request->input('detailed_description');
        $post->slug = $request->input('slug');
        $post->seo_title = $request->input('seo_title');
        $post->seo_keywords = $request->input('seo_keywords');
        $post->seo_description = $request->input('seo_description');
        $post->is_draft = $request->input('is_draft') ? true : false;
        $post->is_published = $request->has('publish');
        
        // Save the post
        if ($post->save()) {
            $postId = $post->id;
            
            // Handle gallery images
            if ($request->hasFile('gallery_images')) {
                $images = $request->file('gallery_images');
                
                foreach ($images as $image) {
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . uniqid() . '.' . $ext;
                    $image->move('assets/uploads/gallery_images', $filename);
                    
                    $postGalleryImage = new PostGalleryImage(['gallery_images' => $filename, 'post_id' => $postId]);
                    $postGalleryImage->save();
                }
            }
        }
        
        return redirect('/posts')->with('status', 'Post Added Successfully');
    }

    public function edit($id)
    {
        $categories =Category::all();
        $tags =Tag::all();
        $posts = Post::with('images')->find($id);
 
        return view('admin.posts.edit', compact('posts','categories','tags'));
    }

    public function update(Request $request, $id)
    {
        $posts = Post::find($id);
        if($request->hasFile('featured_image')){
            $path = 'assets/uploads/featured_image/'.$posts->featured_image;
            if(File::exists($path)){
              File::delete($path);
            }
            $file= $request->file('featured_image');
            $ext = $file->getClientOriginalExtension();
            $filename =time().'.'.$ext;
            $file->move('assets/uploads/featured_image',$filename);
            $posts->featured_image = $filename;
            
        }
        if (!$posts) {
            return redirect('/posts')->with('error', 'Post not found');
        }
    
        //$posts->user_id = $user_id;
    
        // Assign other attributes
        $posts->category_id = $request->input('category_id');
        $posts->tag_id = $request->input('tag_id');
        $posts->title = $request->input('title');
        $posts->short_description = $request->input('short_description');
        $posts->detailed_description = $request->input('detailed_description');
        $posts->slug = $request->input('slug');
        $posts->seo_title = $request->input('seo_title');
        $posts->seo_keywords = $request->input('seo_keywords');
        $posts->seo_description = $request->input('seo_description');
        $posts->is_draft = $request->input('is_draft') ? true : false;
        $posts->is_published = $request->has('is_published')? true : false;
       
           if ($posts->save()) {
            $postId = $posts->id;
    
            if ($request->hasFile('gallery_images')) {
                $images = $request->file('gallery_images');
    
                foreach ($images as $image) {
                    $ext = $image->getClientOriginalExtension();
                    $filename = time() . '_' . uniqid() . '.' . $ext;
                    $image->move('assets/uploads/gallery_images', $filename);
    
                    $postGalleryImage = new PostGalleryImage(['gallery_images' => $filename, 'post_id' => $postId]);
                    $postGalleryImage->save();
                }
            }
    
            return redirect('/posts')->with('success', 'Product updated successfully');
        } else {
            return redirect('/posts')->with('error', 'Error updating product');
        }
    }
    public function destroy($id)
 {
    
     $posts = Post::with('images')->find($id);
 
     
     if (!$posts) {
         return redirect('/posts')->with('error', 'posts not found');
     }
 
 
     foreach ($posts->images as $image) {
        
         if ($image->path) {
             $imagePath = 'path/to/image/directory/' . $image->path;
             if (File::exists($imagePath)) {
                 File::delete($imagePath);
             }
         }
 
        
         $image->delete();
     }
 
 
     $posts->delete();
 
     return redirect('/posts')->with('status', 'posts and associated images deleted successfully');
 }
    

  
 
}
