@extends('layout')

@section('content')

    <h4>Login</h4>

    <form action="login" method="post">
        @csrf

        <div class="form-group mb-2">
            <input type="email" placeholder="Email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Password" name="password" class="form-control">
        </div>
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif


        <div class="form-group row ml-0 mr-0">
            <div class="col-lg-6 col-md-8">

                <label> <input type="checkbox" name="remember" class=""> Remember Me </label>
            </div>
            <div class="col-lg-6 col-md-4">

                <label> <a href="{{ route('forget-password-get') }}">Reset Password</a> </label>
            </div>


        </div>

        <div class="form-group">
            Not registered? <a href="register">register</a>
         </div>
        <div class="form-group mt-2">
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection