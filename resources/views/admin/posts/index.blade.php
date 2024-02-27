@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4>Posts List</h4>
            </div>
            <div class="col-md-6 text-right">
    <a class="btn btn-primary" href="{{url('add-post')}}" style="font-size: 14px;">
        Add Posts
    </a>
</div>
        </div>
        <hr>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Tag</th>
                    <th>Short Description</th>
                    <th>Featured Image</th>
                    <th>Action</th>           
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->title}}</td>
                 <td>{{ optional($item->category)->title }}</td>
                 <td>{{ optional($item->tag)->tag }}</td>
                    <td>{{$item->short_description}}</td>
                    <td>
                    <img src="{{ asset('assets/uploads/featured_image/'.$item->featured_image) }}" class="featured_image" alt="Image here" style="width: 100px; height: auto;">

            </td>
                    <td>
                        <a href="{{url('edit-post/'.$item->id)}}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('delete-post/'.$item->id) }}" class="btn btn-danger delete-category">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $(document).ready(function() {    
        $('.delete-category').click(function(e){
            e.preventDefault(); 
            var deleteUrl = $(this).attr('href');            
            var confirmation = confirm('Are you sure you want to delete?');          
            if (confirmation) {
                window.location.href = deleteUrl; 
            }
        });
    });
</script>

@endsection
