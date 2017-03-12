@extends('Main')

@section('Posts')
    @foreach($articles as $article )
        <div class="blog-post">
            <a href="/article/{{$article->slug}}">
                <h2 class="blog-post-title">{{ $article->title }}</h2>
            </a>

            <p class="blog-post-meta">{{ (new DateTime($article->created))->format('F d, Y') }} by <a href="">Abram</a></p>
            {{ $article->short_descr }}
        </div>
    @endforeach
@endsection

