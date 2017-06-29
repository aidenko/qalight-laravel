@extends('themes.admin.index')

@section('file_css')
    <style>
        .category {
            font-size: .5em;
        }

        .category i {
            font-size: .75em;
        }
    </style>
@stop

@section('file_js')
@stop

@section('template')

    <div class="row">
        <div class="col s12 left-align">
            @can('update', $article)
                <a href="{{route('admin.article.edit', $article->id)}}" class="waves-effect waves-light btn"><i class="material-icons left">mode_edit</i>Edit</a>
            @endcan

            @can('delete', $article)
                <form method="post" action="{{route('admin.article.destroy', $article->id)}}" style="display: inline;">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Delete
                        <i class="material-icons left">delete</i>
                    </button>
                </form>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <h4>{{$article->title}}
                @if($category)
                    <a href="{{route('admin.category.show', $category->id)}}" class="category">
                        <i class="material-icons">link</i>
                        {{$category->name}}
                    </a>
                @endif
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <h6>{{$article->author->name}}</h6>
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