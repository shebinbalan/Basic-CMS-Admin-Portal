@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Tags</h4>
    </div>
<div class="card-body">
    <form action="{{url('insert-tag')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="">Tag</label>
                <input type="text" class="form-control" name="tag">
            </div>
          
            <div class="col-md-12 mb-3">
            <label for="">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
        </div>        
           
            <div class="col-md-12">
             <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection