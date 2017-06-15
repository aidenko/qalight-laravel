@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <h2>Edit article</h2>

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

            <form class="col s12" method="post" action="{{ route('articles.update', $article->id) }}">

                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="title" id="title"  value="{{$article->title}}">
                        <label for="title">Title</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="summary" class="materialize-textarea" id="summary">{{$article->summary}}</textarea>
                        <label for="summary">Summary</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="article" class="materialize-textarea" id="content">{{$article->content}}</textarea>
                        <label for="content">Content</label>
                    </div>
                </div>

                <div class="row">
                    <div class="switch">
                        <label>
                            Active
                            <input type="checkbox" name="active" {{($article->active ? ' checked' : '')}}>
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <br>
                    <h4>Tags</h4>
                    <div class="chips">
                        <div class="chip">Tag 1</div>
                        <div class="chip selected">Tag 2</div>
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