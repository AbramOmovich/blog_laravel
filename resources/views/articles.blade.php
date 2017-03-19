@extends('Main')

@if(isset($message))
    @section('message')
        <p  class="{{ $class }} ">{{ $message }}</p>
    @endsection
@endif

@section('Posts')
    @if (isset($articles))
        @foreach($articles as $article )
            <div class="blog-post">
                <a href="/article/{{$article->slug}}">
                    <h2 class="blog-post-title">{{ $article->title }}</h2>
                </a>
                <p class="blog-post-meta">{{ (new DateTime($article['created_at']))->format('F d, Y') }} by <a href="">Abram</a></p>
                {{ $article['short_descr'] }}
            </div>
        @endforeach
        @section('Pagination')
            <nav>
                <ul class="pager">
                    <li><a href="{{ $articles->previousPageUrl() }}">Previous</a></li>
                    <li><a href="{{ $articles->nextPageUrl() }}">Next</a></li>
                </ul>
            </nav>
        @endsection
    @endif
@endsection

@section('sidebar')
    <form action="{{ route('add') }}">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Добавить новость</button>
    </form>
@endsection