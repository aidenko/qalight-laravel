@extends('themes.admin.index')

@section('file_css')
    <style>
        .chip {
            cursor: pointer;
        }
    </style>
@stop

@section('file_js')
    <script>
        jQuery(document).ready(function () {

            jQuery('select').material_select();

            jQuery('.chip')
                    .hover(
                            function () {
                                jQuery(this).addClass('selected');
                            },
                            function () {
                                if (!jQuery(this).find('input').prop('checked'))
                                    jQuery(this).removeClass('selected');
                            }
                    )
                    .click(function () {
                        var i = jQuery(this).find('input');
                        i.prop('checked', !i.prop('checked'));
                    })
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

            <h2>New article</h2>

            <form class="col s12" method="post" action="{{ route('articles.store') }}">

                {{csrf_field()}}

                <div class="row">
                    <div class="input-field col s12">
                        <select name="category_id">
                            <option value="">No parent</option>
                            @foreach ($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        <label>Parent category</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <select name="author_id">
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}"{{$author->id == $user->id ? 'selected' : ''}}>{{$author->name}}</option>
                            @endforeach
                        </select>
                        <label>Author</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="title" id="title">
                        <label for="title">Title</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="summary" class="materialize-textarea" id="summary"></textarea>
                        <label for="summary">Summary</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="article" class="materialize-textarea" id="content"></textarea>
                        <label for="content">Content</label>
                    </div>
                </div>

                <div class="row">
                    <div class="switch">
                        <label>
                            Active
                            <input type="checkbox" name="active">
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <br>
                    <h4>Tags</h4>
                    <div class="chips">
                        @foreach ($tags as $tag)
                            <div class="chip">
                                {{$tag->name}}
                                <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                            </div>
                        @endforeach
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