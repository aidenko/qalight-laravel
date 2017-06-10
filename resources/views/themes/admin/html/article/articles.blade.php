@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <div class="container">
        <a href="{{route('articles.create')}}">New</a>

        <div class="row">
            <div class="col s12">


                <ul class="collection with-header">
                    <li class="collection-header">
                        <h4 class="">Articles</h4>
                    </li>
                    @foreach($articles as $article)

                        <li class="collection-item">
                            <div>
                                <a class="truncate" href="{{ route('articles.show', $article->id) }}">
                                    {{ $article->title }}
                                </a>
                                <div class="secondary-content">
                                    <input type="checkbox">
                                </div>
                            </div>
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
    </div>
@stop