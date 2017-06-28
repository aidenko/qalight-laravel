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
            @include('themes.admin.include.form-validation-errors')

            <h2>Edit role</h2>

            <form class="col s12" method="post" action="{{ route('admin.role.update', $role->id) }}">

                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="name" id="name" value="{{$role->name}}">
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 switch">
                        <label>
                            Active
                            <input type="checkbox" name="active"{{$role->active ? ' checked' : ''}}>
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <select name="parent_id">
                            <option value="">No parent</option>
                            @foreach ($roles as $r)
                                <option value="{{$r->id}}"{{$r->id == $role->parent_id ? ' selected' : ''}}>{{$r->name}}</option>
                            @endforeach
                        </select>
                        <label>Parent role</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <select name="permissions[]" multiple>
                            <option value="" disabled>Choose permissions</option>
                            @foreach ($permissions as $permission)
                                <option value="{{$permission->id}}"{{$role_permissions->contains($permission->id) ?' selected' : ''}}>{{$permission->name}}</option>
                            @endforeach
                        </select>
                        <label>Permissions</label>
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