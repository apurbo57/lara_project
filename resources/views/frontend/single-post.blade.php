@extends('frontend.components.layouts')

@section('title')
    Single Post View
@endsection


@section('content')
<div class="card mb-4 ">
    <a href="#!"><img class="card-img-top" src="{{ $post->image }}" alt="..." /></a>
    <div class="card-body">
        <div class="small text-muted">{{date('D F,Y', strtotime($post->created_at))}} by <a href="#">{{ $post->user->name }}</a></div>
        <h2 class="card-title">{{$post->title}}</h2>
        <p class="card-text">{{ $post->desc }}</p>
    </div>
</div>
@endsection