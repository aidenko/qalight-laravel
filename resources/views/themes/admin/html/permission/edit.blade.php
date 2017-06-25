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

            <h2>Edit permission</h2>

            <form class="col s12" method="post" action="{{ route('permissions.update', $permission->id) }}">

                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="name" id="name" value="{{$permission->name}}">
                        <label for="name">Name</label>
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