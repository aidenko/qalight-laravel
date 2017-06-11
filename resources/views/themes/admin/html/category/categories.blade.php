@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
@stop

@section('template')

    <div class="container">
        <a href="{{route('categories.create')}}">New</a>

        <div class="row">
            <div class="col s12">


                <ul class="collection with-header">
                    <li class="collection-header">
                        <h4 class="">Categories</h4>
                    </li>
                    @foreach($categories as $category)

                        <li class="collection-item">
                            <div>
                                <a class="truncate" href="{{ route('categories.show', $category->id) }}">
                                    {{ $category->name }}
                                </a>
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