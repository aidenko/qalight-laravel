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
            @can('edit', $role)
                <a href="{{route('admin.role.edit', $role->id)}}" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Edit</a>
            @endcan

            @can('delete', $role)
                <form method="post" action="{{route('admin.role.destroy', $role->id)}}" style="display: inline;">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Delete
                        <i class="material-icons left">delete</i>
                    </button>
                </form>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            @if($parent)
                @can('view', $parent)
                    <a class="parent" href="{{route('admin.role.show', $parent->id)}}">
                @endcan
                    <i class="material-icons">call_missed</i><span>{{$parent->name}}</span>
                @can('view', $parent)
                    </a>
                @endcan
            @endif
            <h4>{{$role->name}}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <h4>Permissions</h4>

            @if($permissions->isEmpty())
                No Permissions
            @else
                <div class="chips">
                    @foreach($permissions as $permission)
                        <div class="chip selected tooltipped" data-html="true" data-position="bottom" data-delay="500" data-tooltip="{{$permission->description}}">{{$permission->name}}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>


@stop