@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script src="https://unpkg.com/vue"></script>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                seen: true,
                greeting: {
                    m: 'Hello!!!'
                }
            }
        });

        jQuery('#app').click(function () {
            app.seen = false;
        });

    </script>
@stop

@section('template')

    <div class="row" id="app">
        <div class="col s12" v-if="seen">
            @{{ greeting.m }}
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