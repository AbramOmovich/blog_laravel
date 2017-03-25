@extends('Main')
@section('title')
    {{ "Редактировать новость" }}
@endsection

@section('message')
    @if ($errors->has('slug'))
        <div class="alert alert-danger"> $errors->first('slug') }}</div>
    @endif
    @if(isset($message))
        <div class="alert {{ $message['class'] }} ">{{ $message['text'] }}</div>
    @endif
@endsection

@section('Posts')
    <div class="blog-post" >
        <form action="{{Request::url()}}" method="post">
            {{ method_field('PUT') }}
            <h2 class="blog-post-title">Заголовок новости</h2>
            <div class="form-group @if($errors->has('title')) {{ 'has-error' }}@endif">
                @if($errors->has('title'))
                    <label class="control-label" for="title"> {{ $errors->first('title') }} </label>
                @endif
                <input type="text" id="title" name="title" class="form-control" height="40" value="@if(isset($article)) {{ $article->title }} @else {{ old('title') }} @endif">
            </div>
            <p>Текст новости</p>
            <div class="form-group @if($errors->has('body')) {{ 'has-error' }} @endif">
                @if($errors->has('body'))
                    <label class="control-label" for="body"> {{ $errors->first('body') }} </label>
                @endif
                <textarea name="body" id="body" cols="30" rows="10" class="form-control">@if(isset($article)) {{ $article->body }} @else {{ old('body') }} @endif </textarea>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @foreach(\App\Tag::all() as $tag )
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @if($article->tags->contains($tag->id)) checked @endif> {{ $tag->title }}
                    </label>
                </div>
            @endforeach

            <br>
            <button type="submit" class="btn btn-default">Редактировать</button>
        </form>
    </div>
@endsection

