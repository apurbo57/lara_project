@extends('admin.components.layouts')

@section('title')
    Update Post
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
        <h5 class="card-header">Update Post</h5>
        <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-select" id="category" name="category">
                        <option selected>Select Category</option>
                        @foreach ($category as $row)
                        <option value="{{ $row->id }}" {{ $post->category_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                        @endforeach
                      </select>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}" placeholder="Enter Your Post title">
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="5">{{ $post->desc }}</textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
</div>

@endsection