@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="login-main">
            <div class="login-head">
                <h1>Login</h1>
            </div>
            <div class="login-block">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    @if ($errors->has('email'))
                        <span class="label label-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <input id="email" type="text" name="email" placeholder="Email" required autofocus
                           value="{{ old('email') }}">
                    @if ($errors->has('password'))
                        <span class="label label-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <input id="password" type="password" name="password" class="lock" placeholder="Password" required>
                    <div class="forgot-top-grids">
                        <div class="forgot-grid">
                            <ul>
                                <li>
                                    <input type="checkbox" id="brand1"
                                           name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="brand1"><span></span>Remember me</label>
                                </li>
                            </ul>
                        </div>
                        <div class="forgot">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" name="Sign In" value="Login" class="login-btn">
                    <h3>Vrei un cont? <a href="{{ route('register') }}">Inregistrare</a></h3>
                </form>
            </div>
        </div>
    </div>

    <!--inner block end here-->
    <!--copy rights start here-->
    <div class="copyrights">
        <p>© 2018 Alaskan Global Network SRL. Toate drepturile rezervate | <a href="https://www.alaskan.ro">www.alaskan.ro</a>
        </p>
        <p class="hidden-all">© 2016 Shoppy. All Rights Reserved | Design by <a href="http://w3layouts.com/"
                                                                                target="_blank">W3layouts</a></p>
    </div>

@endsection
