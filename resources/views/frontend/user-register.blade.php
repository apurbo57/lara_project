@extends('frontend.components.layouts')

@section('title')
    User Registation Form
@endsection


@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h5>User Register Form</h5>
    </div>
     <div class="card-body">
         @if (session('message'))
             <div class="alert alert-{{ session('type') }}">{{ session('message') }}</div>
         @endif
        <form action="{{ route('user.registration') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" placeholder="Enter your name">
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" id="email" placeholder="Enter your e-mail">
                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter your password">
                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="photo">Profile Photo</label>
                <input type="file"  name="photo" id="photo">
                @error('photo')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mt-2 text-right">
                <button type="submit" class="btn btn-primary">Registration</button>
            </div>
        </form>
    </div>
</div>
@endsection