@extends('themes.default.index')

@section('template')
    <div class="container">
        <div class="row">
            <div class="col m6 offset-m3">
                <h4>Register</h4>
                <div class="row">
                    <form class="col s12" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required autofocus>
                                <label for="name" data-error="Name is required">Name</label>
                                @if ($errors->has('name'))
                                    <span class="red-text">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                                <label for="email" data-error="Incorrect email address">E-Mail Address</label>
                                @if ($errors->has('email'))
                                    <span class="red-text">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate" name="password" required>
                                <label for="password" data-error="Password is required">Password</label>
                                @if ($errors->has('password'))
                                    <span class="red-text">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                                <label for="password-confirm" data-error="Confirm password">Confirm Password</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s6">
                                <button class="btn waves-effect waves-light" type="submit">Register
                                    <i class="material-icons left">account_box</i>
                                </button>
                            </div>
                            <div class="col s6">
                                <a class="right" href="{{route('login')}}">Login</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
