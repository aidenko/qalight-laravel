@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <div class="container">
        <div class="row">
            <div class="col s12 left-align">
                <a href="{{route('categories.edit', $category->id)}}" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Edit</a>
                <form method="post" action="{{route('categories.destroy', $category->id)}}" style="display: inline;">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Delete
                        <i class="material-icons left">delete</i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <h4>{{$category->name}}</h4>
            </div>
            <div class="col s12">
                <p>{{$category->parent_id}}</p>
            </div>
        </div>
    </div>
@stop