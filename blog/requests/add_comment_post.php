<?php
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';

if (in_array('', $_POST)) :
    $msg_error = 'Merci de remplir le contenu du commentaire';
    header('Location:' . HOME_URL . 'views/add_comment.php?msg=' . $msg_error);
else :
    $text = trim($_POST['comment']);
    $id = intval($POST['id_article']);

    $req = $db->prepare("INSERT INTO comments
	(id_user, id_article, comment_content, created_at)
	VALUES (:id_user, :id_article, :comment_content, NOW())
	");

    // https://www.php.net/manual/fr/function.intval.php
    $req->bindValue(':id_user', intval($_SESSION['id_user']), PDO::PARAM_INT); // integer
    $req->bindValue(':id_article', $id, PDO::PARAM_INT);  // integer 
    $req->bindValue(':comment_content', $text, PDO::PARAM_STR); // string

    // $result va stocker le résultat de ma requete INSERT INTO
    // si TRUE l'insertion s'est bien déroulé
    // si FALSE une erreur s'est produite
    $result = $req->execute();

    if ($result) {
        header('Location:' . HOME_URL . '?msg=<div class="green">Commentaire ajouté</div>');
    } else {
        header('Location:' . HOME_URL . 'views/add_comment.php?msg=<div class="red">Erreur, merci de renouveler votre commentaire</div>&id=' . $text);
    }

endif;