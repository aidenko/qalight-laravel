@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <div class="row">
        <div class="col s12">

            @include('themes.admin.include.form-validation-errors')

            <h2>New tag</h2>



            <form class="col s12" method="post" action="{{ route('admin.tag.store') }}">

                {{csrf_field()}}
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="name" id="name">
                        <label for="name">Tag name</label>
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