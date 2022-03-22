<?php
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';

if(in_array('', $_POST)) :
	$msg_error = 'Merci de remplir tous les champs manquants';
else :
	$id_role = 3; // il est fixe, donc on le détermine en "dur"
	$first_name = mb_ucfirst($_POST['first_name']); // seulement la première lettre en majuscule
	$last_name 	= mb_strtoupper(trim($_POST['last_name'])); // tout en majuscule
	$pseudo 	= trim($_POST['pseudo']);
	$email 		= filter_var(mb_strtolower(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);
	$pass1 		= trim($_POST['password']);
	$pass2 		= trim($_POST['password2']);
	$match_pass = check_password($pass1); // je check pour voir s'il correspond au pattern

	if($pass1 != $pass2) :
		$msg_error = 'Les mots de passe ne correspondent pas';
	elseif(!$match_pass) :
		$msg_error = 'Le mot de passe ne correspond pas au format exigé';
	else :
		// on vérifie que le pseudo n'existe pas dans la BDD
		$req = $db->prepare("
			SELECT COUNT(id) count_pseudo
			-- je compte le nombre de pseudo identique
			FROM users
			WHERE pseudo = :pseudo
		");

		$req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

		$req->execute();
		$result = $req->fetch(PDO::FETCH_OBJ);

		if($result->count_pseudo) : // si > 0
			$msg_error = 'Ce pseudo existe déjà';
		else :
			$req = $db->prepare("
				SELECT COUNT(id) count_email
				FROM users
				WHERE email = :email
			");

			$req->bindValue(':email', $email, PDO::PARAM_STR);

			$req->execute();

			$result = $req->fetch(PDO::FETCH_OBJ);

			if($result->count_email) : // si > 0
				$msg_error = 'Vous avez déjà un compte avec cet email';
			else :
				$req = $db->prepare("
					INSERT INTO users(id_role, first_name, last_name, pseudo, email, password)
					VALUES (:id_role, :first_name, :last_name, :pseudo, :email, :password)
				");
				$req->bindValue(':id_role', $id_role, PDO::PARAM_INT);
				$req->bindValue(':first_name', $first_name, PDO::PARAM_STR);
				$req->bindValue(':last_name', $last_name, PDO::PARAM_STR);
				$req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
				$req->bindValue(':email', $email, PDO::PARAM_STR);
				// https://www.php.net/manual/fr/function.password-hash.php
				$req->bindValue(':password', password_hash($pass1, PASSWORD_DEFAULT), PDO::PARAM_STR);

				$result = $req->execute();

				if($result) :
					$msg_success = 'Vous êtes bien inscrit';
				else :
					$msg_error = 'Oups !! erreur lors de la création du profil';
				endif;
			endif;
		endif;
	endif;
endif;

if(isset($msg_error)) {
	header('Location:' . HOME_URL . 'views/subscribe.php?msg=' . $msg_error);
}
else {
	header('Location:' . HOME_URL . '?msg=' . $msg_success);
}