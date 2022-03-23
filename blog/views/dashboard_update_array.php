<?php
// mise à jour de l'utilisateur courant
// avec leur nom, prénom, pseudo, email, role,  lien vers les articles (update) et rajout de bouton de suppression (si admin), lien vers les commentaires (update) et rajout de bouton de suppression (si admin)

require __DIR__ . '/header.php';
require_once PATH_PROJECT . '/connect.php';
enabled_access(array('administrator'));
$id_user = intval($_GET['id']); // si le $_GET n'est pas numerique, il ne pourra pas le transformer en integer

if ($id_user) {
	$req = $db->prepare("SELECT u.id, u.first_name, u.last_name, u.pseudo, u.email, a.id id_article, a.title, a.content, c.id id_comment, c.comment_content, r.id id_role
		FROM users u
		LEFT JOIN articles a
		ON u.id = a.id_user
		LEFT JOIN comments c
		ON u.id = c.id_user
		INNER JOIN roles r
		ON u.id_role = r.id
		WHERE u.id = :id
	");
	$req->bindValue(':id', $id_user, PDO::PARAM_INT);
	$req->execute();

	$users = $req->fetchAll(PDO::FETCH_OBJ);
}
$id_user = 0;
?>

<h1 class="title">Formulaire de mise à jour de
    <?php echo sanitize_html($users[0]->first_name . ' ' . $users[0]->last_name); ?></h1>
<main>

    <?php
	$articles = array();
	$comments = array();

	// recupération des roles
	$req = $db->query("
		SELECT *
		FROM roles
	");
	$roles = $req->fetchAll(PDO::FETCH_OBJ);

	foreach ($users as $user) :
		if ($id_user != $user->id) :
			$id_user = $user->id;
	?>
    <div class="file_form">
        <form action="<?php echo HOME_URL . 'requests/dashboard_update_post.php'; ?>" method="POST">
            <div>
                <label for="first_name">Prénom</label>
                <input type="text" id="first_name" name="first_name"
                    value="<?php echo sanitize_html($user->first_name); ?>">
            </div>
            <div>
                <label for="last_name">Nom</label>
                <input type="text" id="last_name" name="last_name"
                    value="<?php echo sanitize_html($user->last_name); ?>">
            </div>
            <div>
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" value="<?php echo sanitize_html($user->pseudo); ?>">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo sanitize_html($user->email); ?>">
            </div>
            <div>
                <label for="role">Role</label>
                <select name="role" id="role">
                    <?php foreach ($roles as $role) : ?>
                    <option value="<?php echo $role->id ?>" <?php if ($role->id == $user->id_role) echo 'selected'; ?>>
                        <?php echo $role->role_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="id_user" value="<?php echo $user->id; ?>">
            <button type="submit">Mettre à jour l'utilisateur</button>
        </form>
    </div>
    <?php
		endif;  // fin de condition d'affichage du formulaire

		if ($user->id_article != NULL) :
			$articles[] = array(
				'id' => $user->id_article,
				'title' => sanitize_html($user->title),
				'content' => sanitize_html($user->content)
			);
		endif;
		if ($user->id_comment != NULL) :
			$comments[] = array(
				'id' => $user->id_comment,
				'content' => sanitize_html($user->comment_content)
			);
		endif;

	endforeach;

	// var_dump($articles);
	// var_dump($comments);

	?>
    <?php if (!empty($articles)) : ?>
    <div class="articles">
        <h2>Les articles</h2>
        <?php foreach ($articles as $article) : ?>
        <div class="article">
            <div>
                <p><?php echo $article['title']; ?></p>
                <p>Résumé : <?php echo $article['content']; ?></p>
            </div>

            <div>
                <!-- update article -->
                <a href="<?php echo HOME_URL . 'views/update_article.php?id=' . $article['id']; ?>"><i
                        class="fa-solid fa-pencil"></i></a>

                <!-- delete article -->
                <a class="delete_article"
                    href="<?php echo HOME_URL . 'requests/delete_article_post.php?id=' . $article['id']; ?>"><i
                        class="fa-solid fa-trash-can"></i></a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($comments)) : ?>
    <div class="comments_dashboard">
        <h2>Les commentaires</h2>
        <?php foreach ($comments as $comment) : ?>
        <div class="comment">
            <p>Commentaire : <?php echo $comment['content']; ?></p>
            <div>
                <!-- update comment -->
                <a href="<?php echo HOME_URL . 'views/comment_update.php?id=' . $comment['id']; ?>"><i
                        class="fa-solid fa-pencil"></i></a>

                <!-- delete comment -->
                <a class="delete_comment"
                    href="<?php echo HOME_URL . 'requests/delete_comment_post.php?id=' . $comment['id']; ?>"><i
                        class="fa-solid fa-trash-can"></i></a>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
    <?php
	endif; ?>
</main>
<?php
include PATH_PROJECT . '/views/pop_up_delete.php';
require __DIR__ . '/footer.php';