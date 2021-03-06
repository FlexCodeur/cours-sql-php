<?php
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';

if (in_array('', $_POST)) :
	$msg_error = 'Merci de remplir tous les champs manquants';
else :
	$id_user = intval($_POST['id_user']);
	$id_role = intval($_POST['role']);
	$first_name = mb_ucfirst($_POST['first_name']); // seulement la première lettre en majuscule
	$last_name 	= mb_strtoupper(trim($_POST['last_name'])); // tout en majuscule
	$pseudo 	= trim($_POST['pseudo']);
	$email 		= filter_var(mb_strtolower(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);

	// on vérifie que le pseudo n'existe pas dans la BDD
	$req = $db->prepare("SELECT COUNT(id) count_pseudo, pseudo
		-- je compte le nombre de pseudo identique
		FROM users
		WHERE pseudo = :pseudo
	");

	$req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

	$req->execute();
	$result = $req->fetch(PDO::FETCH_OBJ);

	if ($result->count_pseudo && $result->pseudo != $pseudo) : // si > 0
		$msg_error = 'Ce pseudo existe déjà';
	else :
		$req2 = $db->prepare("SELECT COUNT(id) count_email, email
			FROM users
			WHERE email = :email
		");

		$req2->bindValue(':email', $email, PDO::PARAM_STR);

		$req2->execute();

		$result2 = $req2->fetch(PDO::FETCH_OBJ);

		if ($result2->count_email && $result2->email != $email) : // si > 0
			$msg_error = 'Vous avez déjà un compte avec cet email';
		else :
			// pseudo et email différent de la BDD
			if ($result->pseudo != $pseudo && $result2->email != $email) :
				$request = "UPDATE users
					SET id_role = :id_role, first_name = :first_name, last_name = :last_name, pseudo = :pseudo, email = :email
					WHERE id = :id_user
				";
				$bind_pseudo = TRUE;
				$bind_email = TRUE;
			// pseudo différent et email identique
			elseif ($result->pseudo != $pseudo && $result2->email == $email) :
				$request = "UPDATE users
					SET id_role = :id_role, first_name = :first_name, last_name = :last_name, pseudo = :pseudo
					WHERE id = :id_user
				";
				$bind_pseudo = TRUE;
				$bind_email = FALSE;
			// pseudo identique et email différent
			elseif ($result->pseudo == $pseudo && $result2->email != $email) :
				$request = "UPDATE users
					SET id_role = :id_role, first_name = :first_name, last_name = :last_name, email = :email
					WHERE id = :id_user
				";
				$bind_pseudo = FALSE;
				$bind_email = TRUE;
			// pseudo identique et email identique
			elseif ($result->pseudo == $pseudo && $result2->email == $email) :
				$request = "UPDATE users
					SET id_role = :id_role, first_name = :first_name, last_name = :last_name
					WHERE id = :id_user
				";
				$bind_pseudo = FALSE;
				$bind_email = FALSE;
			endif;
			$req3 = $db->prepare($request);

			$req3->bindValue(':id_user', $id_user, PDO::PARAM_INT);
			$req3->bindValue(':id_role', $id_role, PDO::PARAM_INT);
			$req3->bindValue(':first_name', $first_name, PDO::PARAM_STR);
			$req3->bindValue(':last_name', $last_name, PDO::PARAM_STR);
			if ($bind_pseudo) {
				$req3->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
			}
			if ($bind_email) {
				$req3->bindValue(':email', $email, PDO::PARAM_STR);
			}

			$result3 = $req3->execute();
			if ($result3) :
				$msg_success = 'Utilisateur modifié';
			else :
				$msg_error = 'Oups !! erreur lors de la mise à jour du profil';
			endif;
		endif;
	endif;
endif;

if (isset($msg_error)) {
	header('Location:' . HOME_URL . 'views/dashboard_update.php?id=' . $id_user . '&msg=' . $msg_error);
} else {
	header('Location:' . HOME_URL . 'views/dashboard_update.php?id=' . $id_user . '&msg=' . $msg_success);
}