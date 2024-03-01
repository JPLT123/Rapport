@component('mail::message')

<img src="{{asset('assets/images/logo_elceto.png')}}" class="logo" alt="Elceto Logo">
Objet : Réponse à votre demande de tâche supplémentaire

Cher/Chère {{ strtoupper($data['Auth_user']->name) }},

J'espère que ce message vous trouve bien.

Je tiens à vous informer que nous avons examiné attentivement votre demande de tâche supplémentaire. Après avoir pris en considération divers facteurs, nous regrettons de vous informer que votre demande n'a pas été retenue pour le moment.

Veuillez comprendre que cette décision ne remet aucunement en question vos compétences ou votre engagement envers l'entreprise. Nos ressources actuelles et nos priorités opérationnelles nous obligent à faire des choix difficiles.

N'hésitez pas à me contacter si vous avez des questions ou des préoccupations supplémentaires concernant cette décision. Nous sommes reconnaissants pour votre compréhension et votre professionnalisme.

Cordialement,

{{ config('app.name') }}
@endcomponent