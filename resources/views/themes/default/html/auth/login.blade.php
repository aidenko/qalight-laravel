@extends('themes.default.index')

@section('template')
    <div class="container">
        <div class="row">
            <div class="col m6 offset-m3">
                <h4>Login</h4>

                <div class="row">
                    <form class="col s12" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" name="email" class="validate" value="{{ old('email') }}" required autofocus>
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
                                <input id="password" type="password" name="password" class="validate" value="{{ old('password') }}" required autofocus>
                                <label for="password">Password</label>
                                @if ($errors->has('password'))
                                    <span class="red-text">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <p>
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <label for="remember">Remember Me</label>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s3">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Login
                                    <i class="material-icons left">perm_identity</i>
                                </button>
                            </div>

                            <div class="col s3">
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    Register
                                    <i class="material-icons left">account_box</i>
                                </a>
                            </div>

                            <div class="col s6">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                    <i class="material-icons left">help_outline</i>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s3">
                                <a href="{{route('auth.github')}}">Github</a>
                            </div>
                            <div class="col s3">
                                <a href="{{route('auth.facebook')}}">Facebook</a>
                            </div>
                            <div class="col s3">
                                <a href="{{route('auth.google')}}">Google</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
