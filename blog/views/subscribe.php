<?php
require __DIR__ . '/header.php';
// les roles qui ont accès à la page
// les autres seront redirigés vers la page HOME
?>

<h1 class="title">Formulaire d'inscription</h1>

<div class="file_form">
	<form action="<?php echo HOME_URL . 'requests/subscribe_post.php'; ?>" method="POST">
		<div>
			<label for="first_name">Prénom<span class="red">*</span></label>
			<input type="text" id="first_name" name="first_name">
		</div>
		<div>
			<label for="last_name">Nom<span class="red">*</span></label>
			<input type="text" id="last_name" name="last_name">
		</div>
		<div>
			<label for="pseudo">Pseudo<span class="red">*</span></label>
			<input type="text" id="pseudo" name="pseudo">
		</div>
		<div>
			<label for="email">Email<span class="red">*</span></label>
			<input type="text" id="email" name="email">
		</div>
		<div>
			<label for="password">Mot de passe<span class="red">*</span></label>
			<input type="password" id="password" name="password">
			<!-- On répete 2 fois le mot de passe pour vérifier qu'il est exact -->
			<input type="password" id="password2" name="password2">
			<p>Mot de passe entre 8 et 16 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial, et pas d'espace</p>
		</div>
		
		<button type="submit">S'inscrire</button>
	</form>
</div>

<?php
require __DIR__ . '/footer.php';
