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

            <h2>Edit permission</h2>

            <form class="col s12" method="post" action="{{ route('admin.permission.update', $permission->id) }}">

                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="name" id="name" value="{{$permission->name}}">
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="description" class="materialize-textarea" id="description">{{$permission->description}}</textarea>
                        <label for="description">Description</label>
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