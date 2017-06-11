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

    <form method="post" action="{{ route('categories.update', $category->id) }}">

        {{csrf_field()}}
        <input name="_method" type="hidden" value="PUT">

        <div>
            <input type="text" name="name" placeholder="Category name" value="{{$category->name}}">
        </div>
        <div>
            <select name="parent_id"></select>
        </div>

        <div>
            <input type="submit" value="update">
        </div>
    </form>

@stop