@extends('layouts.admin')

@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="card">
    <div class="card-header">
        <h4>Add Posts</h4>
    </div>
<div class="card-body">
    <form action="{{url('insert-post')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
           <div class="col-md-6 mb-3">
           <select class="form-control" name="category_id"  >
            <option value="">Select a Category</option>
             @foreach($category as $item)
             <option value="{{$item->id}}">{{$item->title}}</option>
             @endforeach
           
            </select>
            </div>
            <div class="col-md-6 mb-3">
           <select class="form-control" name="tag_id"  >
            <option value="">Select a Tags</option>
             @foreach($tags as $item)
             <option value="{{$item->id}}">{{$item->tag}}</option>
             @endforeach
           
            </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Slug Url</label>
                <input type="text" class="form-control" name="slug">
            </div>
           
            <div class="col-md-12 mb-3">
            <label for=""> Short Description</label>
            <textarea name="short_description" id="short_description" rows="3" class="form-control"></textarea>
            </div>
            <div class="col-md-12 mb-3">
            <label for=""> Detailed  Description</label>
            <textarea name="detailed_description" id="detailed_description" rows="3" class="form-control"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Seo Title</label>
                <input type="text" class="form-control" name="seo_title">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Seo Keywords</label>
                <input type="text" class="form-control" name="seo_keywords">
            </div>
           
            <div class="col-md-12 mb-3">
            <label for=""> Seo Description</label>
            <textarea name="seo_description" id="seo_description" rows="3" class="form-control"></textarea>
            </div>


            <div class="col-md-6 mb-3">
                <label for="">Is Draft</label>
                <input type="checkbox"  name="is_draft">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Publish</label>
                <input type="checkbox"  name="is_published">
            </div>
            <div class="col-md-12">
              <label for="image">Featured image:</label>
            <input type="file" class="form-control" name="featured_image" id="featured_image">
            </div>
            <div class="col-md-12">
            <label for="image">Gallery images:</label>
           <input type="file" class="form-control" name="gallery_images[]" multiple>
          </div>
            <div class="col-md-12">
             <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection