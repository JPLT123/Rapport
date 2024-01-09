@component('mail::message')

<img src="{{asset('assets/images/logo_elceto.png')}}" class="logo" alt="Elceto Logo">

Objet : Approbation de votre planification hebdomadaire

Cher(e) {{ $data['user']->name }},

Nous sommes ravis de vous informer que votre planification hebdomadaire a été examinée et approuvée par votre hierachie {{ $data['Auth_user']->name }}.

Vous pouvez consulter les détails de votre planification en suivant le button ci-dessous :

@component('mail::button', ['url' => route('planification.apercu'),'color' => 'success'])
Accéder à la planification
@endcomponent

Merci de votre engagement et de votre contribution au succès du projet.

Cordialement,

Elceto Holding
@endcomponent