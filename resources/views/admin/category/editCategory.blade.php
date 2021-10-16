@extends('admin.components.layouts')

@section('title')
    Update Category
@endsection


@section('content')
<div class="col-md-5">
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
        <h5 class="card-header">Update Category</h5>
        <form action="{{ route('admin.category.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" placeholder="Enter Your Categoy Name">
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="acive" name="status" value="active" class="custom-control-input" {{ $category->status == 'active'?'checked':'' }}>
                    <label class="custom-control-label" for="acive">Active</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="inacive" name="status" value="inactive" class="custom-control-input" {{ $category->status == 'inactive'?'checked':'' }}>
                    <label class="custom-control-label" for="inacive">Inactive</label>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
</div>

@endsection