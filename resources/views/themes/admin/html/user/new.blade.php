@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
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

            <h2>New user</h2>

            <form class="col s12" method="post" action="{{ route('users.store') }}">

                {{csrf_field()}}

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="name" id="name">
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" name="email" id="email">
                        <label for="email">Email</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="password" name="password" id="password">
                        <label for="password">Password</label>
                    </div>
                </div>

                {{--<div class="row">--}}
                    {{--<div class="switch">--}}
                        {{--<label>--}}
                            {{--Active--}}
                            {{--<input type="checkbox" name="active">--}}
                            {{--<span class="lever"></span>--}}
                        {{--</label>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="row">--}}
                    {{--<br>--}}
                    {{--<h4>Tags</h4>--}}
                    {{--<div class="chips">--}}
                        {{--@foreach ($tags as $tag)--}}
                            {{--<div class="chip">--}}
                                {{--{{$tag->name}}--}}
                                {{--<input type="checkbox" name="tags[]" value="{{$tag->id}}">--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}

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