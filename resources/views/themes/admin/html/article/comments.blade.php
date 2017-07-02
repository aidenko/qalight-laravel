@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery(document).ready(function () {

            jQuery('[name="action"]').click(function () {

                var form = jQuery(this).parent();

                jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/comment/add',
                    data: {
                        _token: '{{csrf_token()}}',
                        text: form.find('[name="comment"]').val(),
                        type: form.find('[name="type"]').val(),
                        id: form.find('[name="id"]').val()
                    }
                });
            });
        });
    </script>
@stop

@section('template')
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="col s12">
                    @include('themes.admin.html.comment.new', ['commentable_type' => get_class($commentable), 'commentable_id' => $commentable->id])
                </div>
            </div>

            @include('themes.admin.html.comment.comments', ['comments' => $commentable->comments])
        </div>
    </div>

@stop