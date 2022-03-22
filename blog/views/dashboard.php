<?php
// recap de tous les utilisateurs
// avec leur nom, prénom, pseudo, email, role, nombre d'articles, nombre de commentaires

require __DIR__ . '/header.php';
require_once PATH_PROJECT . '/connect.php';
enabled_access(['administrator']);

$req = $db->query("SELECT DISTINCT COUNT(c.id) count_comment, COUNT(a.id) count_article, u.*, r.id id_role, r.role_name, r.role_slug, a.id id_article, c.id id_comment
FROM users u 
LEFT JOIN roles r
ON u.id_role = r.id 
LEFT JOIN articles a 
ON a.id_user = u.id 
LEFT JOIN comments c
ON c.id_user = u.id
GROUP BY u.id
ORDER BY r.id ASC
");
$req->execute();

$users = $req->fetchAll(PDO::FETCH_OBJ);
foreach ($users as $user) :
    $id_user = $user->id;
?>
    <div class="article">
        <h2>Utilisateurs</h2>
        <div class="article_action">
            <!-- update article -->
            <a href="<?php echo HOME_URL . 'views/dashboard_update.php?id=' . $id_user; ?>"><i class="fa-solid fa-pencil fa-2x"></i></a>
            <!-- delete article -->
            <a class="delete_article" href="<?php echo HOME_URL . 'requests/dashboard_delete.php?id=' . $id_user; ?>"><i class="fa-solid fa-trash-can fa-2x"></i></a>
        </div>
        <p>Nom : <?php echo sanitize_html($user->last_name); ?></p>
        <p>Prénom : <?php echo sanitize_html($user->first_name) ?></p>
        <!-- https://www.php.net/manual/fr/function.subs// mise à jour de l'utilisateur courant
// avec leur nom, prénom, pseudo, email, role,  lien vers les articles (update) et rajout de bouton de suppression (si admin), lien vers les commentaires (update) et rajout de bouton de suppression (si admin)tr.php -->
        <p>Pseudo : <?= sanitize_html($user->pseudo); ?></p>
        <p>Rôle : <?= sanitize_html($user->role_name) ?></p>
        <p>Email : <?= sanitize_html($user->email); ?></p>
        <p>Nombres d'articles : <?= sanitize_html($user->count_article); ?></p>
        <p>Nombres de commentaires : <?= sanitize_html($user->count_comment); ?></p>
    <?php endforeach; ?>
    </div>