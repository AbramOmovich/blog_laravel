@extends('Main')

@section('title')
    {{ $article->title }}
@endsection

@section('Posts')
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $article->title }}</h2>
        <p class="blog-post-meta">{{ (new DateTime($article->created_at))->format('F d, Y') }} by <a href="{{ route('user' , ['id' => $article->user_id] )}}">{{ ( App\User::find($article->user_id))->name }}</a></p>
        {{ $article->body }}
        <br><br>
            @foreach($article->tags as $tags)
            <a href="/tag/{{ $tags->slug }}" class="label label-info">{{ $tags->title }}</a>
            @endforeach
    </div>
@endsection

@section('sidebar')
    @if(Auth::check())
        @if(Auth::id() == $article->user_id || Auth::user()->role == \App\User::ROLE_ADMIN)
            <form action="{{ Request::url() }}/edit" method="post">
                <button type="submit" class="btn btn-warning btn-lg btn-block"> Редактировать </button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
            <br>
            <form action="{{ Request::url() }}/delete" method="post">
                <button type="submit" class="btn btn-danger btn-lg btn-block"> Удалить </button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        @endif
    @endif
@endsection

