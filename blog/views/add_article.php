<?php
$redirect_to_home = array('user');
require __DIR__ . '/header.php';
?>
<h1>Formulaire d'ajout d'un article</h1>
<div class="file_form">
    <form action="<?php echo HOME_URL . 'requests/add_article_post.php'; ?>" method="POST">
        <div>
            <label for="title">Titre</label>
            <input type="text" id="title" name="title">
        </div>
        <div>
            <label for="text">Contenu de l'article</label>
            <textarea id="text" name="text"></textarea>
        </div>
        <button type="submit">Valider</button>
    </form>
</div>
<?php
require __DIR__ . '/footer.php';