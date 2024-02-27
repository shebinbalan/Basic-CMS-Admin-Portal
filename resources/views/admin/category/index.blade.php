@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4>Category List</h4>
            </div>
            <div class="col-md-6 text-right">
    <a class="btn btn-primary" href="{{url('add-category')}}" style="font-size: 14px;">
        Add Category
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
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>           
                </tr>
            </thead>
            <tbody>
                @foreach($category as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                        <a href="{{url('edit-category/'.$item->id)}}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('delete-category/'.$item->id) }}" class="btn btn-danger delete-category">Delete</a>
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
