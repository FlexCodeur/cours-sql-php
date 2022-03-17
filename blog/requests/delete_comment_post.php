<?php
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';

$comment = intval($_GET['id']);

if ($comment) {
    $req = $db->prepare("DELETE FROM comments 
    WHERE id = :id
	");
    $req->bindValue(':id', $comment, PDO::PARAM_INT);

    $result = $req->execute();

    if ($result) {
        header('Location:' . HOME_URL . '?msg=<div class="green">Article supprimé</div>');
    } else {
        header('Location:' . HOME_URL . '?msg=<div class="red">Erreur lors de la suppression</div>');
    }
}