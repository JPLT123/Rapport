@component('mail::message')

<img src="{{asset('assets/images/logo_elceto.png')}}" class="logo" alt="Elceto Logo">


        Verify your email

        Votre code de vérification est : {{ $verificationCode }}

{{ config('app.name') }}
@endcomponent