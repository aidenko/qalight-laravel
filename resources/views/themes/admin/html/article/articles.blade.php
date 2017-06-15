@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery('.edit, .view').click(function(event){
            event.stopPropagation();
        });
    </script>
@stop

@section('template')


    <div class="row">
        <div class="col s12">

            <h4>
                Articles
                <a href="{{route('articles.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
            </h4>

            <ul class="collapsible" data-collapsible="expandable">

                @foreach($articles as $article)
                    <li>
                        <div class="collapsible-header truncate">

                            {{--<p>--}}
                                {{--<input type="checkbox" id="article-{{$article->id}}" />--}}
                                {{--<label for="article-{{$article->id}}"></label>--}}
                            {{--</p>--}}

                            {{ $article->title }}
                            <a class="teal-text text-darken-1 right edit"  href="{{ route('articles.edit', $article->id) }}" title="Edit article">
                                <i class="material-icons">edit</i>
                            </a>

                            <a class="blue-text text-lighten-2 right view" href="{{ route('articles.show', $article->id) }}" target="_blank" title="View article">
                                <i class="material-icons">open_in_new</i>
                            </a>
                        </div>
                        <div class="collapsible-body grey lighten-4">{{$article->summary}}</div>
                    </li>
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