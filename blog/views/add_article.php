<?php
$enable_access = array('administrator', 'editor');
require __DIR__ . '/header.php';
$title = isset($_DET['title']) ? $_GET['title'] : FALSE;
$title = isset($_DET['content']) ? $_GET['content'] : FALSE;
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
            <textarea id="text" name="text" rows="5"></textarea>
        </div>
        <button type="submit">Valider</button>
    </form>
</div>
<?php
require __DIR__ . '/footer.php';