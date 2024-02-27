@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Posts</h4>
    </div>
<div class="card-body">
    <form action="{{url('update-post/'.$posts->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
           <div class="col-md-6 mb-3">
           <select name="category_id" class="form-control">
    <option value="">Select Category</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ optional($posts->category)->id == $category->id ? 'selected' : '' }}>
            {{ optional($posts->category)->title }}
        </option>
    @endforeach
</select>
            </div>
          
            <div class="col-md-6 mb-3">
            <select class="form-control" name="tag_id">
    <option value="">Select Tag</option>
    @foreach ($tags as $tag)
        <option value="{{ $tag->id }}" {{ optional($posts->tag)->id == $tag->id ? 'selected' : '' }}>
            {{ optional($posts->tag)->tag }}
        </option>
    @endforeach
</select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" value="{{$posts->title}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Slug Url</label>
                <input type="text" class="form-control" name="slug" value="{{$posts->slug}}">
            </div>
           
            <div class="col-md-12 mb-3">
            <label for=""> Short Description</label>
            <textarea name="short_description" id="short_description" rows="3" class="form-control">{{$posts->short_description}}</textarea>
            </div>
            <div class="col-md-12 mb-3">
            <label for=""> Detailed  Description</label>
            <textarea name="detailed_description" id="detailed_description" rows="3" class="form-control">{{$posts->detailed_description}}</textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Seo Title</label>
                <input type="text" class="form-control" name="seo_title" value="{{$posts->seo_title}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Seo Keywords</label>
                <input type="text" class="form-control" name="seo_keywords" value="{{$posts->seo_keywords}}">
            </div>
           
            <div class="col-md-12 mb-3">
            <label for=""> Seo Description</label>
            <textarea name="seo_description" id="seo_description" rows="3" class="form-control">{{$posts->seo_description}}</textarea>
            </div>


            <div class="col-md-6 mb-3">
                <label for="">Is Draft</label>
                <input type="checkbox" name="is_draft" {{ $posts->is_draft ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-3">
              <label for="">Publish</label>
              <input type="checkbox" name="is_published" {{ $posts->is_published ? 'checked' : '' }}>
              </div>
            <div class="col-md-12">
    <label for="featured_image">Featured image:</label>
    <input type="file" class="form-control" name="featured_image" id="featured_image">
    @if ($posts->featured_image)
        <div>
            <img src="{{ asset('assets/uploads/featured_image/'.$posts->featured_image) }}" class="img-fluid" alt="Current Featured Image"  style="width: 100px; height: auto;">
        </div>
    @else
        <p>No featured image available.</p>
    @endif
</div>
<div class="col-md-12">
    <label for="gallery_images">Gallery images:</label>
    <input type="file" class="form-control" name="gallery_images[]" multiple>
</div>

@if ($posts->images->isNotEmpty())
    <div class="row">
        @foreach ($posts->images as $image)
            <div class="col-md-3">
                <img src="{{ asset('assets/uploads/gallery_images/'.$image->gallery_images) }}" class="img-fluid" alt="Gallery Image">
            </div>
        @endforeach
    </div>
@else
    <p>No gallery images available.</p>
@endif
           
            <div class="col-md-12">
             <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection