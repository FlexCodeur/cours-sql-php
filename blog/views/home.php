<?php
require __DIR__ . '/header.php';
require_once PATH_PROJECT . '/connect.php';

// on veut tous les résultats, on injecte pas de variable php dans la requête sql => $db->query suffit
$req = $db->query("
	SELECT a.id, a.id_user, a.title, a.content, a.created_at, u.first_name, u.last_name
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
// $results = $req->fetchAll(); // résultat de la requête
// il peut s'ecrire aussi
// $results = $req->fetchAll(PDO::FETCH_ASSOC);

// si vous voulez un resultat en forme de tableau contenant des objets
$results = $req->fetchAll(PDO::FETCH_OBJ); ?>

<h1>Mon super blog</h1>
<main>
	<?php foreach($results as $result) :

		$id_article = $result->id; ?>
		<!-- 
		exercice :
		ajouter, pour chaque article les icones éditer et supprimer :
		- pour les admins = éditer, supprimer pour tous les articles
		- pour les éditeurs = éditer seulement pour les articles qu'ils ont écrit
		-->
		<article class="article">
			<!-- Bouton action sur l'article si connecté et différent de user -->
			<?php if(isset($_SESSION['id_user']) && $_SESSION['role_slug'] != 'user') : ?>
				<div class="article_action">
					<!-- update article -->
					<a href=""><i class="fa-solid fa-pencil fa-2x"></i></a>
					<!-- delete article -->
					<a href=""><i class="fa-solid fa-trash-can fa-2x"></i></a>
					
				</div>
			<?php endif; ?>
			
			<h2><?php echo $result->title; ?></h2>
			<p>Écrit par <?php echo $result->first_name . ' ' . $result->last_name; ?></p>
			<p>Date : <?= $result->created_at; ?></p>
			<!-- https://www.php.net/manual/fr/function.substr.php -->
			<p>Résumé : <?= substr($result->content, 0, 70); ?> ...</p>
			
			$id_article = $result->id;
			<?php 
			// comme on a besoin d'une variable php pour aliemnter la requête, il faudra faire une requête préparée, pour éviter les injections SQL
			$req = $db->prepare("
				SELECT c.id, c.comment_content, c.created_at, u.pseudo
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
			// var_dump($req->fetch(PDO::FETCH_OBJ)); // FALSE ?>
			<div class="comments">
				<?php while($comment = $req->fetch(PDO::FETCH_OBJ)) : ?>
					<div class="comment">
						<p><?php echo $comment->comment_content; ?></p>
						<p>Commenté par : <?php echo $comment->pseudo ?></p>
						<p>Date : <?php echo $comment->created_at; ?></p>
					</div>
				<?php endwhile; ?>
			</div>
		</article>
	<?php endforeach; ?>
</main>



<?php
require __DIR__ . '/footer.php';