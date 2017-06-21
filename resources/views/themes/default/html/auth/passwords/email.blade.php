@extends('themes.default.index')

@section('template')
    <div class="container">
        <div class="row">
            <div class="col m6 offset-m3">
                <h4>Reset Password</h4>
                <div class="row">
                    @if (session('status'))
                        <div>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="col s12" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

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
                            <div class="col s12">
                                <button type="submit" class="btn">
                                    <i class="material-icons left">email</i>
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
