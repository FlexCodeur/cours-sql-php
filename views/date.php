<?php
define('TITLE', 'Les dates');

include __DIR__ . '/header.php';

// le serveur est souvent paramétré sur le fuseau horaire UTC

// on va mettre au bon fuseau toute la page
// date_default_timezone_set('EUROPE/Paris'); // + 1 heure hiver / + 2 heure été
?>
<main>
    <h1>Les dates</h1>

    <a href="https://www.php.net/manual/fr/datetime.format.php">Lien des format de dates</a>

    <h2>Le mode procédural</h2>
    <pre>
		<?php var_dump(date('Y-m-d H:i:s')); // en procédural 
		?>
	</pre>

    <!-- Pour vérifier le fuseau horaire du serveur -->
    <pre>
		<?php var_dump(date('c')); ?>
	</pre>
    <pre>
		<?php var_dump(date('U')); // timestamp temps en secondes depuis le 1/01/1970 
		?>
	</pre>

    <br><br>
    <h2>Le mode POO</h2>
    <pre>
		<!-- va appliquer le fuseau horaire du serveur avec le parametre date_default_timezone_set -->
		<?php var_dump(new DateTime('now')); // en POO 
		?>
	</pre>
    <?php
	$date1 = new DateTime('now', new DateTimeZone('EUROPE/Paris')); // 1er instance
	$date3 = new DateTime('now', new DateTimeZone('EUROPE/Paris')); // 2eme instance
	$date5 = new DateTime('now', new DateTimeZone('EUROPE/Paris')); // 3eme instance
	$date7 = new DateTime('now', new DateTimeZone('EUROPE/Paris')); // 4eme instance

	var_dump($date1);
	var_dump($date3);
	var_dump($date5);
	var_dump($date7);

	$date2 = $date1;
	$date4 = $date3;
	$date6 = $date5;
	$date8 = $date7;

	// j'ajoute 10 jours à la date initiale
	// l'ajout commence toujours par P puis Y pour année, M pour mois, D pour jour
	// si on veut ajouter des heures (H), minutes (M), secondes (S) on devra comment par T
	// + 10 ans ==> P10Y
	// 
	$date1->add(new DateInterval('P10Y'));
	$date3->add(new DateInterval('P2YP1DT5H20S'));
	$date5->add(new DateInterval('PT5H3M'));
	$date7->add(new DateInterval('P6DT2H'));

	var_dump($date2);
	var_dump($date4);
	var_dump($date6);
	var_dump($date8);

	?>
    <p>Exercice</p>
    <p>Ajouter une date (maintenant)</p>
    <ul>
        <li>2 ans, 1 jour, 5 heures et 20 secondes</li>
        <li>3 mois et 2 heures</li>
        <li>5 heures et 3 minutes</li>
        <li>6 jours et 2 heures</li>
    </ul>
</main>
<?php include __DIR__ . '/footer.php';