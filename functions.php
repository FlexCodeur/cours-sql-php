<?php
session_start(); // obligatoire pour utiliser les sessions
// on définit une constante de cette façon
// define('NOM_DE_LA_CONSTANTE_EN_MAJUSCULE', 'VALEUR_DE_LA_CONSTANTE');
define('HOME_URL', 'http://cours-sql-php/'); // à chaque migration, cet élément sura surement à changer
define('PATH_PROJECT', __DIR__);
define('META_DEFAULT', 'When writing a meta description, keep it between 140 and 160 characters so Google can display your entire message. Don’t forget to include your keyword!');

// URL SITE
define('URL_CONDITIONS', 'views/conditions.php');
define('URL_LOOP', 'views/loop.php');
define('URL_REGEX', 'views/regex.php');
define('URL_DATES', 'views/date.php');

// function pour vérifier si l'url courant correspond à celle du lien
function current_url($url)
{
	$request_uri = substr($_SERVER['REQUEST_URI'], 1); // pour enlever le slash
	if ($request_uri == $url) {
		return TRUE;
	}
	return FALSE;
}