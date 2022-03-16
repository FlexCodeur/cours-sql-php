<?php
require __DIR__ . '/header.php';
require_once PATH_PROJECT . '/connect.php';

// on veut tous les résultats, on injecte pas de variable php dans la requête sql => $db->query suffit
$req = $db->query("SELECT 
	a.id, a.id_user, a.title, a.content, a.created_at, u.first_name, u.last_name
	FROM articles a
	LEFT JOIN users u
	ON u.id = a.id_user
	ORDER BY a.created_at DESC
");
// var_dump($db->errorInfo()); // affiche les erreurs SQL
// on veut récupérer les résultats de la requête donc on utilise un fetch

// Ici on utilise fetchAll pour obtenir tous les résultats d'un seul coup
// il faudra donc les stocker dans une variable avant de l'utiliser

// par defaut, nous obtiendrons un tableau de tableaux
// $articles = $req->fetchAll(); // résultat de la requête
// il peut s'ecrire aussi
// $articles = $req->fetchAll(PDO::FETCH_ASSOC);

// si vous voulez un resultat en forme de tableau contenant des objets
$articles = $req->fetchAll(PDO::FETCH_OBJ);
if (isset($_SESSION['role_slug'])) $role_slug = $_SESSION['role_slug'];
?>

<h1>Mon super blog
    <?php if (isset($role_slug) && $role_slug != 'user') echo "<span><a href=\"" . HOME_URL . "views/add_article.php\"><i class=\"fa-solid fa-circle-plus\"></i></a></span>"; ?>
</h1>
<main>
    <?php foreach ($articles as $article) :

		$id_article = $article->id;
	?>
    <!-- 
		exercice :
		ajouter, pour chaque article les icones éditer et supprimer :
		- pour les admins = éditer, supprimer pour tous les articles
		- pour les éditeurs = éditer seulement pour les articles qu'ils ont écrit
		-->
    <article class="article">
        <!-- Bouton action sur l'article si connecté et différent de user -->
        <?php if (isset($_SESSION['id_user']) && $_SESSION['role_slug'] != 'user') :

			?>
        <div class="article_action">
            <!-- update article -->
            <?php if ($role_slug == "administrator" || ($role_slug == 'editor' && $article->id_user == $_SESSION['id_user'])) : ?>
            <a href="<?php echo HOME_URL . "views/update_article.php?id=" . $id_article; ?>"><i
                    class="fa-solid fa-pencil fa-2x"></i></a>
            <?php endif; ?>
            <!-- delete article -->
            <?php if ($role_slug == 'administrator') : ?>
            <a href=""><i class="fa-solid fa-trash-can fa-2x"></i></a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <h2><?php echo sanitize_html($article->title); ?></h2>
        <p>Écrit par <?php echo sanitize_html($article->first_name . ' ' . $article->last_name); ?></p>
        <p>Date : <?= $article->created_at; ?></p>
        <!-- https://www.php.net/manual/fr/function.substr.php -->
        <p>Résumé : <?= sanitize_html(substr($article->content, 0, 70)); ?> ...</p>
        <?php
			$id_article = $article->id;
			// comme on a besoin d'une variable php pour aliemnter la requête, il faudra faire une requête préparée, pour éviter les injections SQL
			$req = $db->prepare("SELECT 
				c.id, c.id_user, c.comment_content, c.created_at, u.pseudo
				FROM comments c
				INNER JOIN users u
				ON u.id = c.id_user
				WHERE c.id_article = ?
			");
			// Ici on exécute la requête préparée en remplaçant la variable "?" en attente par $id_article
			$req->execute(array($id_article));
			// on a 4 résultats
			// var_dump($req->fetch(PDO::FETCH_OBJ)); // 1er résultat
			// var_dump($req->fetch(PDO::FETCH_OBJ)); // 2ème résultat
			// var_dump($req->fetch(PDO::FETCH_OBJ)); // 3ème résultat
			// var_dump($req->fetch(PDO::FETCH_OBJ)); // 4ème résultat
			// var_dump($req->fetch(PDO::FETCH_OBJ)); // FALSE 
			?>

        <!--
			exercice :
			ajouter le bouton ajouter un commentaire pour les utilisateurs et l'admin
			l'editeur ne pourra ajouter un commentaire que si l'article n'est pas de lui

			exercice 2
			ajouter les boutons editer et supprimer pour uniquement l'admin
			les editeurs et utilisateurs ne pourront éditer et supprimer leurs propres commentaires
			-->
        <div class="comments">

            <?php while ($comment = $req->fetch(PDO::FETCH_OBJ)) : ?>
            <div class="comment">
                <div>
                    <p><?php echo sanitize_html($comment->comment_content); ?></p>
                    <p>Commenté par : <?php echo sanitize_html($comment->pseudo); ?></p>
                    <p>Date : <?php echo $comment->created_at; ?></p>
                </div>
                <div class="comment_action">
                    <?php
							$enabled_comment = array('editor', 'user');
							if (
								isset($role_slug)
								&&
								($role_slug == "administrator"
									||
									(
										// (
										// 	$role_slug == 'editor' && $comment->id_user == $_SESSION['id_user']
										// )
										// ||
										// (
										// 	$role_slug == 'user' && $comment->id_user == $_SESSION['id_user']
										// )
										in_array($role_slug, $enabled_comment) && $comment->id_user == $_SESSION['id_user']
									)
								)
							) : ?>
                    <a href=""><i class="fa-solid fa-pencil"></i></a>
                    <a href=""><i class="fa-solid fa-trash-can"></i></a>
                    <?php endif; ?>
                </div>

            </div>
            <?php endwhile; ?>
            <?php
				if (
					isset($role_slug) // je vérifie si la variable existe (au cas où je suis déconnecté)
					&&
					(
						($role_slug == 'administrator'
							||
							$role_slug == 'user'
						)
						||
						($role_slug == 'editor'
							&&
							$_SESSION['id_user'] != $article->id_user // id_user connecté != id_user de l'article
						)
					)

				) : ?>
            <p><a href=""><i class="fa-solid fa-circle-plus"></i> Ajouter un commentaire</a></p>
            <?php endif; ?>
        </div>
    </article>
    <?php endforeach; ?>
</main>



<?php
require __DIR__ . '/footer.php';