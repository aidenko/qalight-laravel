@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery(document).ready(function () {
            jQuery('select').material_select();

            var permissions = jQuery('[name="p_incl[]"], [name="p_excl[]"]');

            permissions.change(function(){
                permissions.filter('[value="' + this.value + '"]').not(this).prop('checked', false);
            });
        });
    </script>
@stop

@section('template')

    <div class="row">
        <div class="col s12 left-align">
            @include('themes.admin.include.form-validation-errors')
            <h2>Edit User</h2>

            <form class="col s12" method="post" action="{{ route('admin.user.update', $user->id) }}">

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
                            <option value="" disabled>Choose roles</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}"{{$user_roles->contains($role->id) ? ' selected' : ''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                        <label>Roles</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <h4>Permissions</h4>

                        <table class="striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>By role</th>
                                <th>Include</th>
                                <th>Exclude</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $p)
                                <tr>
                                    <td>{{$p->name}}</td>
                                    <td>
                                        <p>
                                            <input type="checkbox" id="rp-{{$p->id}}" disabled{{$rp->contains($p->id) ? ' checked' : ''}}/>
                                            <label for="rp-{{$p->id}}"></label>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <input type="checkbox" id="ip-{{$p->id}}" name="p_incl[]" value="{{$p->id}}"{{$up->has($p->id) && $up[$p->id] ? ' checked' : ''}}/>
                                            <label for="ip-{{$p->id}}"></label>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <input type="checkbox" id="ep-{{$p->id}}" name="p_excl[]" value="{{$p->id}}"{{$up->has($p->id) && !$up[$p->id] ? ' checked' : ''}}/>
                                            <label for="ep-{{$p->id}}"></label>
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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