@extends('themes.admin.index')

@section('file_css')
@stop

@section('file_js')
    <script>
        jQuery('.edit, .view').click(function (event) {
            event.stopPropagation();
        });
    </script>
@stop

@section('template')

    <div class="row">
        <h4>
            Categories
            @can('create', App\Category::class)
                <a href="{{route('admin.category.create')}}" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>New</a>
            @endcan
        </h4>

        <ul class="collapsible" data-collapsible="expandable">
            @foreach($categories as $category)
                @can('view', $category)
                    <li>
                        <div class="collapsible-header truncate">
                            {{ $category->name }}

                            @can('update', $category)
                                <a class="teal-text text-darken-1 right edit" href="{{ route('admin.category.edit', $category->id) }}" title="Edit category">
                                    <i class="material-icons">edit</i>
                                </a>
                            @endcan

                            @can('view', $category)
                                <a class="blue-text text-lighten-2 right view" href="{{ route('admin.category.show', $category->id) }}" target="_blank" title="View category">
                                    <i class="material-icons">open_in_new</i>
                                </a>
                            @endcan
                        </div>
                        <div class="collapsible-body grey lighten-4">{{$category->name}}</div>
                    </li>
                @endcan
            @endforeach
        </ul>

    </div>

    <div class="row">
        <div class="col s12 right-align">
            <div class="waves-effect waves-light btn-floating"><i class="material-icons">delete</i>button</div>
            <div class="waves-effect waves-light btn-floating"><i class="material-icons left">cloud</i>button</div>
        </div>
    </div>
@stop