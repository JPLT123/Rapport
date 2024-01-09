@component('mail::message')

<img src="http://127.0.0.1:8000/public/assets/images/logo_elceto.png" class="logo" alt="Elceto Logo">

Sujet : Approbation de votre planification hebdomadaire avec modifications

Cher(e) [Nom de l'utilisateur],

Nous espérons que vous allez bien. Nous sommes ravis de vous informer que votre planification hebdomadaire a été approuvée. Cependant, veuillez noter que des modifications ont été apportées par votre supérieur hiérarchique pour optimiser certains aspects.

Voici l'object de la modification :

[Inclure ici une liste des modifications spécifiques ou des commentaires de l'hierarchie, le cas échéant.]

Vous pouvez accéder à la planification en cliquant sur le bouton ci-dessous :

@component('mail::button', ['url' => route('planification.apercu'),'color' => 'success'])
Accéder à la planification
@endcomponent

Nous apprécions votre compréhension et votre collaboration dans ce processus. Nous sommes convaincus que ces ajustements contribueront à optimiser l'efficacité de votre planification hebdomadaire.

Merci de votre engagement envers l'excellence et de votre contribution à la réussite de notre équipe.

Cordialement,

Votre équipe {{ config('app.name') }}
@endcomponent