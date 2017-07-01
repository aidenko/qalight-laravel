@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery('.edit, .view').click(function (event) {
            event.stopPropagation();
        });
    </script>
@stop

@section('template')

    <div class="row">
        <h4>
            Roles
            @can('create', App\Role::class)
                <a href="{{route('admin.role.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
            @endcan
        </h4>

        <ul class="collapsible" data-collapsible="expandable">
            @foreach($roles as $role)
                @can('view', $role)
                    <li>
                        <div class="collapsible-header truncate">
                            {{ $role->name }}

                            @can('edit', $role)
                                <a class="teal-text text-darken-1 right edit" href="{{ route('admin.role.edit', $role->id) }}" title="Edit role">
                                    <i class="material-icons">edit</i>
                                </a>
                            @endcan

                            @can('view', $role)
                                <a class="blue-text text-lighten-2 right view" href="{{ route('admin.role.show', $role->id) }}" target="_blank" title="View role">
                                    <i class="material-icons">open_in_new</i>
                                </a>
                            @endcan
                        </div>
                        <div class="collapsible-body grey lighten-4">
                            <h6>Permissions</h6>
                            {{$role->permissions->pluck('name')->implode(', ')}}
                        </div>
                    </li>
                @endcan
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