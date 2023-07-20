@extends('layout')

@section('content')
<main class="login-form">

    <div class="cotainer">
  
        <div class="row justify-content-center">
  
            <div class="col-md-8">
  
                <div class="card">
  
                    <div class="card-header">Reset Password</div>
  
                    <div class="card-body">
  
    
  
                      @if (Session::has('message'))
  
                           <div class="alert alert-success" role="alert">
  
                              {{ Session::get('message') }}
  
                          </div>
  
                      @endif
  
    
  
                        <form action="{{ route('forget-password-post') }}" method="POST">
  
                            @csrf
  
                            <div class="form-group row">
  
                                <div class="form-group mb-2">
                                    <input type="email" placeholder="Email" name="email" class="form-control">

                                    @if ($errors->has('email'))

                                        <span class="text-danger">{{ $errors->first('email') }}</span>

                                    @endif
                                </div>
  
                            </div>
  
                            <div class="form-group">
  
                                <button type="submit" class="btn btn-primary">
  
                                    Send Password Reset Link
  
                                </button>
  
                            </div>
  
                        </form>
  
                          
  
                    </div>
  
                </div>
  
            </div>
  
        </div>
  
    </div>
  
  </main>
@endsection