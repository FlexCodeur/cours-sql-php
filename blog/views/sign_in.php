<?php
require __DIR__ . '/header.php';
// require_once PATH_PROJECT . '/connect.php';
$id_role        = intVal(3);
$first_name     = isset($_GET['first_name']) ? $_GET['first_name'] : FALSE;
$last_name      = isset($_GET['last_name']) ? $_GET['last_name'] : FALSE;
$pseudo         = isset($_GET['pseudo']) ? $_GET['pseudo'] : FALSE;
$email          = isset($_GET['email']) ? $_GET['email'] : FALSE;
$password       = isset($_GET['password']) ? $_GET['password'] : FALSE;
?>

<h1 class="title">Créez votre compte</h1>

<div class="file_form">
    <form action="<?php echo HOME_URL . 'requests/sign_in_post.php'; ?>" method="POST">
        <div>
            <label for="first_name">Prénom</label>
            <input type="text" id="first_name" name="first_name" value="<?php if ($first_name) echo ($first_name); ?>"
                required>
        </div>
        <div>
            <label for="last_name">Nom</label>
            <input type="text" id="last_name" name="last_name" value="<?php if ($last_name) echo ($last_name); ?>"
                required>
        </div>
        <div>
            <label for="text">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?php if ($pseudo) echo ($pseudo); ?>" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php if ($email) echo ($email); ?>" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" value="<?php if ($password) echo ($password); ?>"
                required>
        </div>
        <input type="hidden" name="id_role" value="<?php echo $id_role; ?>">
        <button type="submit">Valider l'inscription</button>
    </form>
</div>

<?php
require __DIR__ . '/footer.php';