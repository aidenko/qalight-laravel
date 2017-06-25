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
            Roles
            <a href="{{route('role.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
        </h4>

        <ul class="collapsible" data-collapsible="expandable">
            @foreach($roles as $role)

                <li>
                    <div class="collapsible-header truncate">
                        {{ $role->name }}
                        <a class="teal-text text-darken-1 right edit"  href="{{ route('role.edit', $role->id) }}" title="Edit role">
                            <i class="material-icons">edit</i>
                        </a>

                        <a class="blue-text text-lighten-2 right view" href="{{ route('role.show', $role->id) }}" target="_blank" title="View role">
                            <i class="material-icons">open_in_new</i>
                        </a>
                    </div>
                    <div class="collapsible-body grey lighten-4">{{$role->name}}</div>
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