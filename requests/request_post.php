<?php
require_once dirname(__DIR__) . '/functions.php';
var_dump($_POST);
foreach($_FILES as $file) {
	var_dump($file);
}
var_dump($_COOKIE['test_cookie']);
var_dump($_SESSION['user']);
echo '$_REQUEST<br>';
var_dump($_REQUEST);
?>
<a href="<?php echo HOME_URL; ?>">Retour à la page d'accueil</a>

