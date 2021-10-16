@extends('admin.components.layouts')

@section('title')
    Manage Category
@endsection


@section('content')

<h4>Manage Categories</h4>

<div class="col-md-12 text-right">
    <a class="btn btn-primary" href="{{route('admin.category.create')}}">Add Category</a>
</div>

@if (session('message'))
    <div class="alert alert-{{session('type')}}">{{session('message')}}</div>
@endif

<table class="table table-bordered table-striped mt-2">
    <tr>
        <th>Sl No</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach ($category as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->slug }}</td>
            <td>{{ ucfirst($row->status) }}</td>
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