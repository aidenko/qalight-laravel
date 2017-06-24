@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <div class="row">
        <div class="col s12 left-align">
            <a href="{{route('users.edit', $user->id)}}" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Edit</a>
            <form method="post" action="{{route('users.destroy', $user->id)}}" style="display: inline;">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn waves-effect waves-light" type="submit" name="action">Delete
                    <i class="material-icons left">delete</i>
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col s6">
            <div class="card grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Name</span>
                    {{$user->name}}
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="card grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Email</span>
                    {{$user->email}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <br>
            <h4>Roles</h4>

            @if ($user->roles->isEmpty())
                No Roles
            @else
                <div class="chips">
                    @foreach($user->roles as $role)
                        <div class="chip selected">{{$role->name}}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@stop