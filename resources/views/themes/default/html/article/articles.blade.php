@extends('themes.default.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <h1>Articles</h1>

    @foreach($articles as $article)

        <div class="article">
            <p>{{ $article->title }}</p>
        </div>

    @endforeach

@stop