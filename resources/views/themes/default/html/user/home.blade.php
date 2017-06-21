@extends('themes.default.index')

@section('template')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul>
                    <li>
                        <form method="post" action="{{route('logout')}}">

                            {{csrf_field()}}

                            <button type="submit" class="btn">
                                Logout
                                <i class="material-icons left">pan_tool</i>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
