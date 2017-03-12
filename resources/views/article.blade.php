@extends('Main')

@section('Posts')
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $article->title }}</h2>
        <p class="blog-post-meta">{{ (new DateTime($article->created))->format('F d, Y') }} by <a href="">Abram</a></p>
        {{ $article->body }}
    </div>
@endsection

