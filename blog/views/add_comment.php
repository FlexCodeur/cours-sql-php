<?php
$enable_access = array('editor', 'user');
require __DIR__ . '/header.php';
require_once PATH_PROJECT . '/connect.php';

$id_article = intval($_GET['id']); // si le $_GET n'est pas numerique, il ne pourra pas le transformer en integer

if ($id_article) {
    $req = $db->prepare("SELECT id
		FROM articles
		WHERE id = :id
	");

    $req->bindValue(':id', $id_article, PDO::PARAM_INT);
    $req->execute();

    $article = $req->fetch(PDO::FETCH_OBJ);
}

?>

<h1 class="title">Formulaire d'ajout d'un commentaire</h1>

<div class="file_form">
    <form action="<?php echo HOME_URL . 'requests/add_comment_post.php'; ?>" method="POST">
        <div>
            <label for="text">Contenu du commentaire</label>
            <textarea id="text" name="comment" rows="10"></textarea>
        </div>
        <input type="hidden" name="id_article" value="<?php echo $article->id; ?>">
        <button type="submit">Valider</button>
    </form>
</div>

<?php
require __DIR__ . '/footer.php';