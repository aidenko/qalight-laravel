@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')

    <script src="https://unpkg.com/vue"></script>

    <script>
        jQuery('.edit, .view').click(function (event) {
            event.stopPropagation();
        });

        var searchs = new Vue({
            el: '#list',
            data: {
                search: ''
            },
            methods: {
                match: function (name) {
                    return this.search == '' || name.indexOf(this.search) >= 0;
                }
            }
        });
    </script>
@stop

@section('template')

    <div class="row" id="list">
        <h4>
            Permissions <span><input type="text" v-model="search"></span>
            @can('create', App\Permission::class)
                <a href="{{route('admin.permission.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
            @endcan
        </h4>

        <ul class="collapsible" data-collapsible="expandable">
            @foreach($permissions as $permission)
                @can('view', $permission)
                    <li v-if="match('{{ $permission->name }}')">
                        <div class="collapsible-header truncate">
                            {{ $permission->name }}


                            @can('edit', $permission)
                                <a class="teal-text text-darken-1 right edit" href="{{ route('admin.permission.edit', $permission->id) }}" title="Edit permission">
                                    <i class="material-icons">edit</i>
                                </a>
                            @endcan

                            @can('view', $permission)
                                <a class="blue-text text-lighten-2 right view" href="{{ route('admin.permission.show', $permission->id) }}" target="_blank" title="View permission">
                                    <i class="material-icons">open_in_new</i>
                                </a>
                            @endcan
                        </div>
                        <div class="collapsible-body grey lighten-4">{{$permission->description}}</div>
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