<?php 
// dirname va permettre de reculer d'un parent sur le chemin serveur
// var_dump(__DIR__);
// var_dump(dirname(__DIR__));
// var_dump(dirname(dirname(__DIR__)));
// function time() donne le timestamp immédiat
setcookie('test_cookie','valeur du cookie', time() + 60*60*24*365, '/');
require_once dirname(__DIR__) . '/functions.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>cours php | <?php echo TITLE; ?></title>
	<link rel="stylesheet" href="<?php echo HOME_URL; ?>assets/css/dist/main.min.css">
	<!-- https://www.php.net/manual/fr/function.defined.php -->
	<?php if(defined('META_DESCRIPTION')) : ?>
		<meta name="description" content="<?php echo META_DESCRIPTION; ?>">
	<?php else : ?>
		<meta name="description" content="<?php echo META_DEFAULT; ?>">
	<?php endif; ?>
</head>
<body>
	<header>
		<nav>
			<ul>
				<li class="<?php if(current_url('')) echo 'active' ?>"><a href="<?php echo HOME_URL; ?>">Les variables</a></li>
				<li class="<?php if(current_url(URL_CONDITIONS)) echo 'active' ?>"><a href="<?php echo HOME_URL . URL_CONDITIONS; ?>">Les conditions</a></li>
				<li class="<?php if(current_url(URL_LOOP)) echo 'active' ?>"><a href="<?php echo HOME_URL . URL_LOOP; ?>">Les boucles</a></li>
				<li class="<?php if(current_url(URL_REGEX)) echo 'active' ?>"><a href="<?php echo HOME_URL . URL_REGEX; ?>">Les Regex</a></li>
				<li class="<?php if(current_url(URL_DATES)) echo 'active' ?>"><a href="<?php echo HOME_URL . URL_DATES; ?>">Les Dates</a></li>
			</ul>
		</nav>

	</header>
	<div class="content_page">