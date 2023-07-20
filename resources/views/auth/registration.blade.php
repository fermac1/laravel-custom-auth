@extends('layout')

@section('content')

     <h4>Registration</h4>

<form action="registration" method="post">
    @csrf
    <div class="form-group mb-2">
        <input type="name" placeholder="Name" name="name" class="form-control">
    </div>
    <div class="form-group mb-2">
        <input type="email" placeholder="Email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <input type="password" placeholder="Password" name="password" class="form-control">
    </div>

    <div class="form-group">
       Already registered? <a href="/">login</a>
    </div>

    <div class="form-group mt-2">
        <button type="submit">Submit</button>
    </div>
</form>
@endsection