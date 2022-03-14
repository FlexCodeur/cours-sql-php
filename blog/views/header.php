<?php
require dirname(__DIR__) . '/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo HOME_URL . 'assets/css/dist/main.min.css'; ?>">
</head>
<body>
	<header>
		<div class="connect">
			<div class="to_connect">Se connecter</div>
			<div class="modal_connect">
				<form action="<?php echo HOME_URL . 'requests/login_post.php'; ?>" method="POST">
					<p>Se connecter</p>
					<div>
						<label for="email">Email</label>
						<input type="text" name="email" id="email">
					</div>
					<div>
						<label for="password">Mot de passe</label>
						<input type="password" name="password" id="password">
					</div>
					<button type="submit">Envoyer</button>
				</form>
			</div>
		</div>
	</header>

	<div class="content_page">
	
