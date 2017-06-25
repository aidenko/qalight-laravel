@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery('.edit, .view, .delete').click(function(event){
            event.stopPropagation();
        });
    </script>
@stop

@section('template')


    <div class="row">
        <div class="col s12">

            <h4>
                Users
                <a href="{{route('admin.user.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
            </h4>

            <ul class="collapsible" data-collapsible="expandable">

                @foreach($users as $user)
                    <li>
                        <div class="collapsible-header truncate">

                            {{ $user->name }}
                            <a href="mailto:{{$user->email}}" target="_blank">&lt;{{ $user->email }}&gt;</a>

                            <a href="#" class="red-text text-lighten-2 right delete">
                                <i class="material-icons">delete</i>
                            </a>

                            <a class="teal-text text-darken-1 right edit"  href="{{ route('admin.user.edit', $user->id) }}" title="Edit user">
                                <i class="material-icons">edit</i>
                            </a>

                            <a class="blue-text text-lighten-2 right view" href="{{ route('admin.user.show', $user->id) }}" target="_blank" title="View user">
                                <i class="material-icons">open_in_new</i>
                            </a>

                        </div>
                        <div class="collapsible-body grey lighten-4">{{$user->id}}</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col s12 right-align">
            <div class="waves-effect waves-light btn-floating"><i class="material-icons">delete</i>button</div>
            <div class="waves-effect waves-light btn-floating"><i class="material-icons left">cloud</i>button</div>
        </div>
    </div>
@stop