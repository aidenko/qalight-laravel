@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <h1>Tags</h1>

    <a href="{{route('tags.create')}}">New</a>
    <br><br>

    @foreach($tags as $tag)

        <div class="tag">
            <p>
                <a class="a" href="{{ route('tags.show', $tag->id) }}">
                    {{ $tag->name }}
                </a>
            </p>
        </div>

    @endforeach

@stop