@component('mail::message')

<img src="{{asset('assets/images/logo_elceto.png')}}" class="logo" alt="Elceto Logo">

Sujet : Rejet de votre planification hebdomadaire

Cher(e) {{ $data['user']->name }},

Nous espérons que ce message vous trouve bien. Nous tenons à vous informer que votre planification hebdomadaire a été récemment examinée par votre supérieur hiérarchique et a été rejetée pour certaines modifications.

Voici un résumé des commentaires de votre supérieur hiérarchique :

{{ $data['object'] }}

Pour apporter les modifications nécessaires à votre planification, veuillez Cliquez sur le bouton ci-dessous :

@component('mail::button', ['url' => route('planification.Update', ['slug' => $data['user']->slug]),'color' => 'success'])
Modifier la planification
@endcomponent

N'oubliez pas de prendre en compte les commentaires de votre supérieur hiérarchique lors de la modification de votre planification.

Une fois les ajustements effectués, veuillez soumettre à nouveau votre planification pour révision.

Cordialement,


Votre équipe {{ config('app.name') }}
@endcomponent