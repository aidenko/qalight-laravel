@extends('themes.admin.index')

@section('file_css')
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
            <h4>
                Tags
                <a href="{{route('tags.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
            </h4>

            <br>
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