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
        <form action="{{ route('admin.category.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="Enter Your Categoy Name">
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
</div>

@endsection