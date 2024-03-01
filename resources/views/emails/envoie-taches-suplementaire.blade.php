@component('mail::message')

<img src="{{asset('assets/images/logo_elceto.png')}}" class="logo" alt="Elceto Logo">

Cher/Chère {{ strtoupper($data['Auth_user']->name) }},

J'espère que ce message vous trouve bien.

Je suis heureux/heureuse de vous informer que votre demande de tâche supplémentaire a été examinée et acceptée. Votre initiative et votre volonté de contribuer davantage au travail de l'équipe ont été remarquées et appréciées.

Je reste à votre disposition pour toute clarification supplémentaire concernant cette nouvelle attribution de tâches. Nous sommes convaincus que cette opportunité sera enrichissante tant pour vous que pour l'équipe dans son ensemble.

Cordialement,

{{ config('app.name') }}
@endcomponent