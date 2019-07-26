@extends('layouts.app')

@section('content')
    <div class="signup-page-main">
        <div class="signup-main">
            <div class="signup-head">
                <h1>Sign Up</h1>
            </div>
            <div class="signup-block">
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    @if ($errors->has('name'))
                        <span class="label label-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Name" required>
                    @if ($errors->has('email'))
                        <span class="label label-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    @if ($errors->has('password'))
                        <span class="label label-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <input id="password" type="password" class="lock" placeholder="Password" name="password" required>
                    <input id="password-confirm" type="password" class="lock" placeholder="Confirm Password"
                           name="password_confirmation" required>

                    <input type="submit" name="Sign In" value="Sign up">
                </form>
                <div class="sign-down">
                    <h4>Already have an account? <a href="{{ route('login') }}"> Login here.</a></h4>
                    <h5><a href="{{ route('login') }}">Go Back to Home</a></h5>
                </div>
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
