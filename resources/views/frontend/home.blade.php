@extends('frontend.components.layouts')

@section('title')
    Blog Home
@endsection


@section('content')

@foreach ($posts as $post)
<x-single-post :post="$post">
    
</x-single-post>
@endforeach

@endsection