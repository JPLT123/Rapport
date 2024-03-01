@component('mail::message')

<img src="{{asset('assets/images/logo_elceto.png')}}" class="logo" alt="Elceto Logo">
Objet : Urgence - Projet {{ strtoupper($data['projet']) }}

Cher/Chère {{ strtoupper($data['name']) }},

Nous espérons que vous allez bien. Nous tenons à vous informer qu'une mise à jour importante concernant le projet {{ strtoupper($data['projet']) }} est nécessaire.

Après avoir examiné la situation, nous avons constaté qu'il est impératif de traiter immédiatement certaines circonstances imprévues pour assurer le succès du projet.

En conséquence, le projet {{ strtoupper($data['projet']) }} a été classé comme priorité urgente. Nous vous demandons donc de concentrer vos efforts et votre attention supplémentaires sur ce projet afin de respecter les délais et les objectifs établis.

N'hésitez pas à contacter {{ strtoupper($data['responsable']) }} pour obtenir des informations supplémentaires ou discuter de toute question ou préoccupation que vous pourriez avoir concernant ce projet urgent.

Nous vous remercions de votre coopération et de votre engagement continu envers le succès de nos projets.

Cordialement,

{{ config('app.name') }}
@endcomponent