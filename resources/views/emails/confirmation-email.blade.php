@component('mail::message')

<img src="http://127.0.0.1:8000/public/assets/images/logo_elceto.png" class="logo" alt="Elceto Logo">

# Planification de la semaine envoyée

Cher responsable,

Nous tenons à vous informer que la planification de la semaine de collègue {{ $data['Auth_user']->name }} a été envoyée.

Vous pouvez accéder à la planification en cliquant sur le bouton ci-dessous :

@component('mail::button', ['url' => route('planification-detail', ['slug' => $data['Auth_user']->slug]),'color' => 'success'])
Accéder à la planification
@endcomponent

Nous vous prions de bien vouloir vérifier les détails et de confirmer si cette planification est en accord avec les objectifs du projet.

Merci,

Votre équipe {{ config('app.name') }}
@endcomponent