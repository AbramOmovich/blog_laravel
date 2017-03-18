@extends('Main')
@section('title')
    @if (Request::is('article/*'))
        {{ "Редактировать новость" }}
    @else
        {{ "Добавить новость" }}
    @endif
@endsection

@if(isset($message))
@section('message')
    <p  class="{{ $message['class'] }} ">{{ $message['text'] }}</p>
@endsection
@endif

@section('Posts')
    <div class="blog-post" >
        <form action="{{Request::url()}}" method="post">
            <div class="form-group">
                <label for="title"><h2 class="blog-post-title">{{ "Заголовок новости" }}</h2></label>
                <input type="text" id="title" name="title" class="form-control" height="40" @if(isset($title)) value="{{ $title }}" @endif>
            </div>
            <div class="form-group">
                <label for="body">Текст новости</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control">@if(isset($body)){{ $body }} @endif</textarea>
            </div>
            @if (Request::is('article/*'))
                {!! '<input type="hidden" name="set" value="true">' !!}
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default">Опубликовать</button>
        </form>
    </div>
@endsection

