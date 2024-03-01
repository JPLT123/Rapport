@component('mail::message')

<img src="{{asset('assets/images/logo_elceto.png')}}" class="logo" alt="Elceto Logo">

# Rapport journalier envoyé

Cher responsable,

Nous tenons à vous informer que le Rapport HEBDOMADAIRE de votre collègue {{ strtoupper($data['Auth_user']->name) }} a été envoyé.

Vous pouvez accéder au Rapport en cliquant sur le bouton ci-dessous :

@component('mail::button', ['url' => route('affiche-rapport-semaine', ['slug' => $data['rapport']]),'color' => 'primary'])
Accéder au Rapport
@endcomponent

Merci,

Votre équipe {{ config('app.name') }}
@endcomponent
