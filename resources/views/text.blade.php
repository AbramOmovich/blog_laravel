@extends('Main')
@section('text-greet')
    @foreach($articles as $article)
        <h3>{{$article->title}}</h3>
        <p></p>
    @endforeach

  @endsection