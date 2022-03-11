<?php 
// dirname va permettre de reculer d'un parent sur le chemin serveur
// var_dump(__DIR__);
// var_dump(dirname(__DIR__));
// var_dump(dirname(dirname(__DIR__)));
// function time() donne le timestamp immédiat
setcookie('test_cookie','valeur du cookie', time() + 60*60*24*365, '/');
require_once dirname(__DIR__) . '/functions.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>cours php | intro</title>
	<link rel="stylesheet" href="<?php echo HOME_URL; ?>assets/css/dist/main.min.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="<?php echo HOME_URL; ?>">Les variables</a></li>
				<li><a href="<?php echo HOME_URL; ?>views/conditions.php">Les conditions</a></li>
				<li><a href="">lien 3</a></li>
				<li><a href="">lien 4</a></li>
				<li><a href="">lien 5</a></li>
			</ul>
		</nav>

	</header>
	<div class="content_page">