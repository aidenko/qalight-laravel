@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')


    <div class="row">
        <div class="col s12 left-align">

            <a href="{{route('tag.edit', $tag->id)}}" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Edit</a>
            <form method="post" action="{{route('tag.destroy', $tag->id)}}" style="display: inline;">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn waves-effect waves-light" type="submit" name="action">Delete
                    <i class="material-icons left">delete</i>
                </button>
            </form>

            <h1>{{$tag->name}}</h1>

        </div>
    </div>

@stop