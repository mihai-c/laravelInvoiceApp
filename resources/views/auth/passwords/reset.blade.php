@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="login-main">
            <div class="login-head">
                <h1>Reset Password</h1>
            </div>
            <div class="login-block">
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">
                    @if ($errors->has('email'))
                        <span class="label label-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <input id="email" type="text" placeholder="Enter your Email address" name="email"
                           value="{{ $email or old('email') }}" required autofocus>
                    @if ($errors->has('password'))
                        <span class="label label-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <input id="password" type="password" placeholder="Enter your new password" name="password" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="label label-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                    <input id="password-confirm" type="password" placeholder="Confirm your new password"
                           name="password_confirmation" required>
                    <input type="submit" name="Reset" value="Reset Password" class="login-btn">
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
