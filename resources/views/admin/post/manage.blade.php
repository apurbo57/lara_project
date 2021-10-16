@extends('admin.components.layouts')

@section('title')
    Manage Post
@endsection


@section('content')

<h4>Manage Posts</h4>

<div class="col-md-12 text-right">
    <a class="btn btn-primary" href="{{route('admin.post.create')}}">Add Post</a>
</div>

@if (session('message'))
    <div class="alert alert-{{session('type')}}">{{session('message')}}</div>
@endif

<table class="table table-bordered table-striped mt-2">
    <tr>
        <th>Sl No</th>
        <th>Name</th>
        <th>Image</th>
        <th>Category Id</th>
        <th>Action</th>
    </tr>
    @foreach ($post as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->title }}</td>
            <td>{{ $row->image }}</td>
            <td>{{ $row->category_id }}</td>
            <td>
                <form action="{{ route('admin.category.destroy', $row->id) }}" method="post"> 
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-primary sm" href="{{ route('admin.category.edit', $row->id) }}">Edit</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection