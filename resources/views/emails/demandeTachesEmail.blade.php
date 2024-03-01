@component('mail::message')

<img src="{{asset('assets/images/logo_elceto.png')}}" class="logo" alt="Elceto Logo">

Objet : Notification : Demande de Tâche Supplémentaire

Cher/Chère {{ strtoupper($data['Auth_user']->name) }},

Je vous informe par la présente que j'ai soumis une demande de tâche supplémentaire afin d'apporter une contribution accrue à notre équipe.

Je reste à votre disposition pour toute clarification supplémentaire concernant cette demande.

Cordialement,

{{ config('app.name') }}
@endcomponent