@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <div class="row">
        <div class="col s12 left-align">
            <a href="{{route('articles.edit', $article->id)}}" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Edit</a>
            <form method="post" action="{{route('articles.destroy', $article->id)}}" style="display: inline;">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn waves-effect waves-light" type="submit" name="action">Delete
                    <i class="material-icons left">delete</i>
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <h4>{{$article->title}}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card grey darken-2">
                <div class="card-content white-text">
                    <span class="card-title">Summary</span>
                    {{$article->summary}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card grey lighten-4">
                <div class="card-content">
                    {{$article->content}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <br>
            <h4>Tags</h4>

            @if ($tags->isEmpty())
                No tags
            @else
                <div class="chips">
                    @foreach($tags as $tag)
                        <div class="chip selected">{{$tag->name}}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@stop