@component('mail::message')

<img src="{{asset('assets\images\logo_elceto.png')}}" class="logo" alt="Elceto Logo">

<p>{{ $message }}</p>

{{ config('app.name') }}
@endcomponent