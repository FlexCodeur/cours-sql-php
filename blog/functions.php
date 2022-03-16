<?php
session_start(); // obligatoire pour utiliser les sessions
// condition pour rediriger vers la homePage si $redirect_to_home existe et n'est pas nul
if (isset($redirect_to_home)) :
    if (
        !isset($_SESSION['id_user'])
        ||
        (isset($_SESSION['id_user'])
            &&
            in_array($_SESSION['role_slug'], $redirect_to_home)
        )
    ) :
        header('Location: ' . HOME_URL);
    endif;
endif;
// on définit une constante de cette façon
// define('NOM_DE_LA_CONSTANTE_EN_MAJUSCULE', 'VALEUR_DE_LA_CONSTANTE');
define('HOME_URL', 'http://blog/'); // à chaque migration, cet élément sura surement à changer
define('PATH_PROJECT', __DIR__);