@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery(document).ready(function () {
            jQuery('select').material_select();
        });
    </script>
@stop

@section('template')

    <div class="row">
        <div class="col s12 left-align">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2>Edit User</h2>

            <form class="col s12" method="post" action="{{ route('users.update', $user->id) }}">

                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="name" id="name" value="{{$user->name}}">
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" name="email" id="email" value="{{$user->email}}">
                        <label for="email">Email</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="password" name="password" id="password" value="{{$user->password}}">
                        <label for="password">Password</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <select name="roles[]" multiple>
                            <option value="">No Roles</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}"{{$user_roles->contains($role->id) ? ' selected' : ''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                        <label>Roles</label>
                    </div>
                </div>

                <div class="row">
                    <br>
                    <button class="btn waves-effect waves-light" type="submit" name="action">
                        Save
                        <i class="material-icons left">save</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop