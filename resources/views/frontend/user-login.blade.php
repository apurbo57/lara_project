@extends('frontend.components.layouts')

@section('title')
    User Login Form
@endsection


@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h5>User Login Form</h5>
    </div>
     <div class="card-body">
        <form action="{{ route('user.login') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
            <div class="form-group mt-2 text-right">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection