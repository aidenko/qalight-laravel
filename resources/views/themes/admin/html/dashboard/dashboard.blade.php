@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <div class="row">
        <div class="col s12">
            Hello!
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <ul>
                <li>
                    <form method="post" action="{{route('admin.logout')}}">

                        {{csrf_field()}}

                        <button type="submit" class="btn">
                            Logout
                            <i class="material-icons left">pan_tool</i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

@stop