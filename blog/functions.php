<?php
session_start(); // obligatoire pour utiliser les sessions
// condition pour rediriger vers la homePage si $redirect_to_home existe et n'est pas nul
if (
    !isset($_SESSION['id_user'])
    ||
    (isset($enable_access)
        &&
        isset($_SESSION['id_user'])
        &&
        !in_array($_SESSION['role_slug'], $enable_access)
    )
) :
    header('Location: ' . HOME_URL);
endif;

// Pour éliminer la faille XSS
function sanitize_html($string)
{
    // https://www.php.net/manual/fr/function.htmlspecialchars.php
    return htmlspecialchars(trim($string));
}
// on définit une constante de cette façon
// define('NOM_DE_LA_CONSTANTE_EN_MAJUSCULE', 'VALEUR_DE_LA_CONSTANTE');
define('HOME_URL', 'http://blog/'); // à chaque migration, cet élément sura surement à changer
define('PATH_PROJECT', __DIR__);