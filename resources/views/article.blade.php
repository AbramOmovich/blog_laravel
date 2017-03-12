@extends('Main')

@section('Posts')
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $article->attributes->title }}</h2>
        <p class="blog-post-meta">{{ (new DateTime($article->attributes->created))->format('F d, Y') }} by <a href="">Abram</a></p>
        {{ $article->attributes->body }}
    </div>
@endsection

