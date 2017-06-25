@extends('themes.admin.index')

@section('file_css')
    <style>
        .parent {
            display: flex;
            align-items: center;
        }

        .parent i {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .parent span {
            font-size: 24px;
        }
    </style>
@stop

@section('file_js')
@stop

@section('template')


    <div class="row">
        <div class="col s12 left-align">
            <a href="{{route('permissions.edit', $permission->id)}}" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Edit</a>
            <form method="post" action="{{route('permissions.destroy', $permission->id)}}" style="display: inline;">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn waves-effect waves-light" type="submit" name="action">Delete
                    <i class="material-icons left">delete</i>
                </button>
            </form>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card grey darken-2">
                    <div class="card-content white-text">
                        <span class="card-title">Name</span>
                        {{$permission->name}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop