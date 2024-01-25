<?php
use Illuminate\Support\Str;

if (!function_exists('generateUserSlug')) {
    function generateUserSlug($username)
    {
        $now = now(); // Récupère la date et l'heure actuelles
        $formattedDate = $now->format('Ymd-His-u'); // Formatage de la date selon vos besoins

        // Concaténation du nom d'utilisateur et de la date formatée pour créer le slug
        $slug = Str::slug($username) . '-' . $formattedDate;

        return $slug;
    }
}
