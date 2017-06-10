@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <a href="{{route('tags.edit', $tag->id)}}">
        Edit
    </a>

    <form method="post" action="{{route('tags.destroy', $tag->id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="DELETE">

        <input type="submit" value="Delete">
    </form>

    <h1>{{$tag->name}}</h1>

@stop