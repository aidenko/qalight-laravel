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

    <form method="post" action="{{ route('articles.store') }}">

        {{csrf_field()}}

        <div>
            <input type="text" name="title" placeholder="Article title">
        </div>
        <div>
            <textarea name="summary" placeholder="Article teaser"></textarea>
        </div>
        <div>
            <textarea name="article" placeholder="Article content"></textarea>
        </div>
        <div>
            <label>
                Active
                <input type="checkbox" name="active">
            </label>
        </div>

        <div>
            <input type="submit" value="create">
        </div>
    </form>

@stop