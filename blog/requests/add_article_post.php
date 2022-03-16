<?php
require dirname(__DIR__) . '/functions.php';
require_once PATH_PROJECT . '/connect.php';
var_dump($_SESSION);
if (in_array('', $_POST)) :
    $msg_error = 'Merci de remplir le titre et le contenu de l\'article';
else :
    $title = trim($_POST['title']);
    $text = trim($_POST['text']);
    $req = $db->prepare("INSERT INTO 
    articles(id_user, title, content, created_at)
    VALUES 
    (:id_user, :title, :content, NOW())
    ");
    // https://www.php.net/manual/fr/function.intval.php
    $req->bindValue(':id_user', intval($_SESSION['id_user']), PDO::PARAM_INT); // integer
    $req->bindValue(':title', $title, PDO::PARAM_STR); // string
    $req->bindValue(':content', $text, PDO::PARAM_STR); // string
    $result = $req->execute();

    if ($result) {
        header('location: ' . HOME_URL . '?msg=<div  class="green">Article ajouté</div>');
    } else {
        header('location: ' . HOME_URL . 'views/    add_article.php?msg=<div class="red">Merci de renouveler votre article</div>&title=' . $title . 'content' . $text);
    }
endif;