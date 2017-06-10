@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <h2>New article</h2>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('tags.update', $tag->id) }}">

        {{csrf_field()}}
        <input name="_method" type="hidden" value="PUT">

        <div>
            <input type="text" name="name" placeholder="Tag name" value="{{$tag->name}}">
        </div>

        <div>
            <input type="submit" value="update">
        </div>
    </form>

@stop