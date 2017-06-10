@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <a href="{{route('articles.edit', $article->id)}}">
        Edit
    </a>

    <form method="post" action="{{route('articles.destroy', $article->id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="DELETE">

        <input type="submit" value="Delete">
    </form>

    <h1>{{$article->title}}</h1>

@stop