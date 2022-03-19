<?php
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';
var_dump($_POST);
if (in_array('', $_POST)) :
    $msg_error = 'Merci de remplir les champs manquants';
    header('Location:' . HOME_URL . 'views/sign_in.php?msg=' . $msg_error);
else :
    $id_role        = intval($_POST['id_role']);
    $first_name     = sanitize_html($_POST['first_name']);
    $last_name      = sanitize_html($_POST['last_name']);
    $pseudo         = sanitize_html($_POST['pseudo']);
    $email          = sanitize_html($_POST['email']);
    $password       = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $req = $db->prepare("INSERT INTO `users`(id_role, first_name, last_name, pseudo, email, `password`)
    VALUES (:id_role, :first_name, :last_name, :pseudo, :email, :password) 
	");
    // https://www.php.net/manual/fr/function.intval.php
    $req->bindValue(':id_role', $id_role, PDO::PARAM_INT);
    $req->bindValue(':first_name', $first_name, PDO::PARAM_STR); // string
    $req->bindValue(':last_name', $last_name, PDO::PARAM_STR); // string
    $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR); // string
    $req->bindValue(':email', $email, PDO::PARAM_STR); // string
    $req->bindValue(':password', $password, PDO::PARAM_STR); // string
    // $result va stocker le résultat de ma requete INSERT INTO
    // si TRUE l'insertion s'est bien déroulé
    // si FALSE une erreur s'est produite
    $result = $req->execute();
    if ($result) :
        header('Location: ' . HOME_URL . '?msg=<div class="green">Votre compte a été créé</div>');
    else :
        header('Location: ' . HOME_URL . 'views/sign_in.php?msg=<div class="red">Erreur, merci de renouveler votre article</div>&first_name=' . $first_name . '&last_name=' . $last_name . '&pseudo=' . $pseudo . '&email=' . $email);
    endif;

endif;