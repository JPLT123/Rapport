@extends('layouts.app')
@section('content')
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary"> Reset Password</h5>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div>
                            <a href="index.html">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="assets\images\logo_elceto.png" alt="" class="rounded-circle" height="55">
                                    </span>
                                </div>
                            </a>
                        </div>
                        
                        <div class="p-2">
                            <div class="alert alert-success text-center mb-4" role="alert">
                                {{ __('Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-info">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                        
                                <div class="mb-3">
                                    <label for="email" value="{{ __('Email') }}" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" >
                                </div>
            
                                <div class="text-center">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit"> {{ __('Email Password Reset Link') }}</button>
                                </div>
                            </form>
                        </div>
    
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Remember It ? <a href="{{route('login')}}" class="fw-medium text-primary"> Sign In here</a> </p>
                    <p>© <script>document.write(new Date().getFullYear())</script> Elceto Holding. Crafted with <i class="mdi mdi-heart text-danger"></i> by technical team</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
