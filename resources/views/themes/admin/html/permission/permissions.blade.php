@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery('.edit, .view').click(function(event){
            event.stopPropagation();
        });
    </script>
@stop

@section('template')

    <div class="row">
        <h4>
            Permissions
            <a href="{{route('admin.permission.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
        </h4>

        <ul class="collapsible" data-collapsible="expandable">
            @foreach($permissions as $permission)

                <li>
                    <div class="collapsible-header truncate">
                        {{ $permission->name }}
                        <a class="teal-text text-darken-1 right edit"  href="{{ route('admin.permission.edit', $permission->id) }}" title="Edit permission">
                            <i class="material-icons">edit</i>
                        </a>

                        <a class="blue-text text-lighten-2 right view" href="{{ route('admin.permission.show', $permission->id) }}" target="_blank" title="View permission">
                            <i class="material-icons">open_in_new</i>
                        </a>
                    </div>
                    <div class="collapsible-body grey lighten-4">{{$permission->name}}</div>
                </li>

            @endforeach
        </ul>

    </div>

    <div class="row">
        <div class="col s12 right-align">
            <div class="waves-effect waves-light btn-floating"><i class="material-icons">delete</i>button</div>
            <div class="waves-effect waves-light btn-floating"><i class="material-icons left">cloud</i>button</div>
        </div>
    </div>
@stop