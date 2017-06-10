@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <h1>Articles</h1>

    <a href="{{route('articles.create')}}">New</a>
    <br><br>

    @foreach($articles as $article)

        <div class="article2">
            <p>
                <a class="a" href="{{ route('articles.show', $article->id) }}">
                    {{ $article->title }}
                </a>
            </p>
        </div>

    @endforeach

@stop