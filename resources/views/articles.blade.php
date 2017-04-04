@extends('Main')

@if(isset($message))
    @section('message')
        <div class="alert {{ $class }} ">{{ $message }}</div>
    @endsection
@endif

@if(isset($tag))
    @section('Tag')
        <blockquote class="blockquote-reverse"><h3>{{ $tag }}</h3></blockquote>
        <hr>
    @endsection
@endif
@section('Posts')
    @if (isset($articles))
        @foreach($articles as $article )
            <div class="blog-post">
                <a href="/article/{{$article->slug}}">
                    <h2 class="blog-post-title">{{ $article->title }}</h2>
                </a>
                <p class="blog-post-meta">{{ (new DateTime($article['created_at']))->format('F d, Y') }} by <a href="{{ route('user' , ['id' => $article->user_id] ) }}">{{ ( App\User::find($article->user_id))->name }}</a></p>
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
    @if(!Auth::guest())
        <a href="{{ route('add') }}" class="btn btn-primary btn-lg btn-block">Добавить новость</a>
    @endif
@endsection