@extends('admin.components.layouts')

@section('title')
    Add Post
@endsection


@section('content')
<div class="col-md-8">
    @if (session('message'))
        <div class="alert alert-{{ session('type') }}">{{ session('message') }}</div>
    @endif
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
        <h5 class="card-header">Add New Post</h5>
        <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-select" id="category" name="category">
                        <option selected>Select Category</option>
                        @foreach ($category as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                      </select>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="Enter Your Title">
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <br>
                    <input type="file" name="image" id="image">
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
</div>

@endsection