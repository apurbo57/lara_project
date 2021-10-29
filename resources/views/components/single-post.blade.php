<div class="card mb-4">
    <a href="#!"><img class="card-img-top" style="width: 850px ; height: 350px;" src="{{$post->image}}" alt="..." /></a>
    <div class="card-body">
        <div class="small text-muted">January 1, 2021</div>
        <h2 class="card-title">{{ $post->title }}</h2>
        <p class="card-text">{!! substr($post->desc, 0,150) !!}...</p>
        <a class="btn btn-primary" href="{{ route('post', $post->slug) }}">Read more →</a>
    </div>
    <div class="card-footer text-muted">
        Posted on {{date('D F,Y', strtotime($post->created_at))}} by 
        <a href="#">{{ $post->user->name }}</a>
    </div>
</div>

</nav>