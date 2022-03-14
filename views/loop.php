<?php
// pour appeler des fichiers on va avoir plusieurs méthode

// include // s'il ne trouve pas le fichier, une erreur sera déclarée mais continuera le script
// include_once // idem include mais si le fichier est déjà chargé, il ne chargera pas une seconde fois
// require // s'il ne trouve pas le fichier, il y aura une erreur fatale, donc blocage du script
// require_once // idem require mais si le fichier est déjà chargé, il ne chargera pas une seconde fois

// __DIR__ est une constante php qui donne le path serveur du dossier parent où se trouve le fichier courant
include __DIR__ . '/header.php'; ?>
<main>
    <h1>Les boucles</h1>
    <h2>La boucles FOR</h2>

    <pre>
        <code>
            $max= 50;
            for($i; $i < $max; $i++) {
                // Your code
            }
        </code>
    </pre>
    <?php $max = 50;
    for ($i = 0; $i < 50; $i++) {
        $plural = $i > 1 ? 's' : '';
        echo "{$i} tour{$plural} de boucle</br>";
    }
    ?>
    <br>
    <h2>La boucles WHILE</h2>
    <pre>
        <code>
            $max = 10;
            $count = 1;
            while($count < $max) {
                // Your code
            }
        </code>
    </pre>
    <?php
    $max = 10;
    $count = 1;
    while ($count <= $max) {
        $plural = $count > 1 ? 's' : '';
        echo "{$count} tour{$plural} de boucle</br>";
        $count++;
    }
    ?>
    <br>
    <h2>La boucles DO WHILE</h2>
    <pre>
        <code>
            $max = 10;
            $count = 1;
            do {
            $count < $max 
                // Your code
                $count++;
            }
            while($count < $max);
        </code>
    </pre>
    <?php
    $max = 10;
    $count = 1;
    do {
        $plural = $count > 1 ? 's' : '';
        echo "{$count} tour{$plural} de boucle</br>";
        $count++;
    } while ($count <= $max)
    ?>
    <br>
    <h2>La boucles FOREACH</h2>
    <p>Cette boucle spécifiquement faite pour parcourir les tableaux</p>
    <?php
    $array = [
        "Nom" => "REZGANE",
        "Prénom" => "Mehdi",
        "Genre" => "Masculin",
        "âge" => "37 ans"
    ];
    ?>
    <h3>FOREACH avec value</h3>
    br>
    <pre>
        <code>
            foreach($array as $value) {
                // Your code...
            }
        </code>
    </pre>
    <br>
    <pre>
        <code>
            foreach($array as $key => $value) {
                // Your code...
            }
        </code>
    </pre>
    <?php
    foreach ($array as $value) {
        echo $value . "<br>";
    };
    ?>
    <?php
    foreach ($array as $key => $value) {
        echo mb_strtoupper($key) . " : " . $value . "<br>";
    };
    ?>
</main>
<?php include __DIR__ . '/footer.php';