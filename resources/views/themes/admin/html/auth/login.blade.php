<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>QALight-Laravel | Admin</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <link href="themes/default/css/style.css">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col m6 offset-m3">
            <h4>Login</h4>

            <div class="row">
                <form class="col s12" method="POST" action="{{ route('admin.login') }}">
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
                        <div class="col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Login
                                <i class="material-icons left">perm_identity</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<script src="assets/js/common.js"></script>

</body>
</html>