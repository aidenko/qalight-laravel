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

            <h2>New Role</h2>

            <form class="col s12" method="post" action="{{ route('admin.role.store') }}">

                {{csrf_field()}}

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="name" id=name">
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 switch">
                        <label>
                            Active
                            <input type="checkbox" name="active">
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <select name="parent_id">
                            <option value="">No parent</option>
                            @foreach ($roles as $r)
                                <option value="{{$r->id}}">{{$r->name}}</option>
                            @endforeach
                        </select>
                        <label>Parent role</label>
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