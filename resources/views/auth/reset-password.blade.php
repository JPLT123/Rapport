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
                                        <h5 class="text-primary">Reset your password</h5>
                                    </div>
                                </div>
                                <div class="col-4 align-self-end">
                                    <img src="{{asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0"> 
                            <div>
                                <a href="#">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{asset('assets\images\logo_elceto.png')}}" alt="" class="rounded-circle" height="55">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                
                                <x-validation-errors class="mb-4 text-danger" />
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                
                                    <div class="block mb-3">
                                         <div class="block">
                                            <x-label for="email" value="{{ __('Email') }}" class="form-label"/>
                                            <x-input   id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                        </div>   
                                    </div>
            
                                    <div class="mb-3">
                                        <div class="mt-4">
                                            <x-label for="password" value="{{ __('Password') }}" />
                                            <x-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
                                        </div>  
                                    </div>
            
                                    <div class="mb-3">
                                        <div class="mt-4">
                                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                            <x-input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        </div>       
                                    </div>
                
                                    <div class="mt-4 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">{{ __('Reset Password') }}</button>
                                    </div>
                                </form>
                            </div>
        
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        
                        <div>
                            <p>© <script>document.write(new Date().getFullYear())</script> Elceto Holding. Crafted with <i class="mdi mdi-heart text-danger"></i> by technical team</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
{{-- <x-validation-errors class="mb-4" />

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="block">
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
    </div>

    <div class="mt-4">
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
    </div>

    <div class="mt-4">
        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button>
            {{ __('Reset Password') }}
        </x-button>
    </div>
</form> --}}
@endsection
