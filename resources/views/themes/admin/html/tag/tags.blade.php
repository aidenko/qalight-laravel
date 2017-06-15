@extends('themes.admin.index')

@section('file_css')
    <style>
        .chip a {
            color: rgba(0, 0, 0,)
        }

    </style>
@stop

@section('file_js')

    <script>
        jQuery(document).ready(function () {
            jQuery('.chip').hover(function () {
                        jQuery(this).addClass('selected');
                    },
                    function () {
                        jQuery(this).removeClass('selected');
                    })
        });

    </script>
@stop

@section('template')

    <div class="row">
        <div class="col s12">
            <h1>Tags</h1>
            <a href="{{route('tags.create')}}" class="waves-effect waves-light btn"><i class="material-icons left">add</i>New</a>
            <br><br>
            <div class="chips">

                @foreach($tags as $tag)

                    <a href="{{ route('tags.show', $tag->id) }}" target="_blank">
                        <div class="chip">
                            {{ $tag->name }}
                        </div>
                    </a>

                @endforeach
            </div>
        </div>
    </div>

@stop