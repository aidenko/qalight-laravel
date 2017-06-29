@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery('.active, .edit, .view, .delete').click(function (event) {
            event.stopPropagation();
        });
    </script>
@stop

@section('template')


    <div class="row">
        <div class="col s12">

            <h4>
                Articles
                @can('create', App\Article::class)
                    <a href="{{route('admin.article.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
                @endcan
            </h4>

            <ul class="collapsible" data-collapsible="expandable">

                @foreach($articles as $article)
                    @can('view', $article)
                        <li>
                            <div class="collapsible-header truncate">

                                {{ $article->title }}

                                <div class="actions right">

                                    <div class="switch left active">
                                        <label>
                                            Active
                                            <input type="checkbox"{{$article->active ? ' checked' : ''}}>
                                            <span class="lever"></span>
                                        </label>
                                    </div>
                                    @can('view', $article)
                                        <a class="blue-text text-lighten-2 view" href="{{ route('admin.article.show', $article->id) }}" target="_blank" title="View article">
                                            <i class="material-icons">open_in_new</i>
                                        </a>
                                    @endcan

                                    @can('update', $article)
                                        <a class="teal-text text-darken-1 edit" href="{{ route('admin.article.edit', $article->id) }}" title="Edit article">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    @endcan

                                    @can('delete', $article)
                                        <span class="delete">
                                            <input type="checkbox" id="article-{{$article->id}}"/>
                                            <label for="article-{{$article->id}}">&nbsp;</label>
                                        </span>
                                    @endcan
                                </div>

                            </div>
                            <div class="collapsible-body grey lighten-4">
                                {{$article->author->name}}
                                <br>
                                {{$article->summary}}
                            </div>
                        </li>
                    @endcan
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col s12 right-align">
            <div class="waves-effect waves-light btn-floating"><i class="material-icons">delete</i>button</div>
            <div class="waves-effect waves-light btn-floating"><i class="material-icons left">cloud</i>button</div>
        </div>
    </div>
@stop