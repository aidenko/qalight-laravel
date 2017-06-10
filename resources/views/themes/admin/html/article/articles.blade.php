@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <h1>Articles</h1>

    @foreach($articles as $article)

        <div class="article">
            <p>
                <a href="{{ route('articles.show', $article->id) }}">
                    {{ $article->title }}
                </a>
            </p>
        </div>

    @endforeach

@stop