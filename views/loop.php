<?php
// pour appeler des fichiers on va avoir plusieurs méthode

// include // s'il ne trouve pas le fichier, une erreur sera déclarée mais continuera le script
// include_once // idem include mais si le fichier est déjà chargé, il ne chargera pas une seconde fois
// require // s'il ne trouve pas le fichier, il y aura une erreur fatale, donc blocage du script
// require_once // idem require mais si le fichier est déjà chargé, il ne chargera pas une seconde fois

// __DIR__ est une constante php qui donne le path serveur du dossier parent où se trouve le fichier courant
define('TITLE', 'Les boucles');
include __DIR__ . '/header.php'; ?>
<main>
	<h1>Les boucles PHP</h1>
	<br><br>
	<h2>La boucle FOR</h2>
	<br>
	<pre>
		<code>
$max = 50;
for($i = 1; $i <= $max; $i++) {
	// your code...
}
		</code>
	</pre>
	<?php 
	$max = 10;
	for($i = 1; $i <= $max; $i++) {
		$plural = $i > 1 ? 's' : ''; // opérateur ternaire
		echo "{$i} tour{$plural} de boucle<br>";
	}
	?>
	<br><br>
	<h2>La boucle WHILE</h2>
	<br>
	<pre>
		<code>
$max = 50;
$count = 1
while($count <= $max) {
	// your code...
	$count++;
}
		</code>
	</pre>
	<?php 
	$max = 10;
	$count = 1;
	while($count <= $max) {
		$plural = $count > 1 ? 's' : ''; // opérateur ternaire
		echo "{$count} tour{$plural} de boucle<br>";
		$count++;
	}

	 ?>
	<br><br>
	<h2>La boucle DO...WHILE</h2>
	<p>Cette boucle est identique à la boucle while mais va executer les instructions 1 fois avant de vérifier la condition</p>
	<br>
	<pre>
		<code>
$max = 50;
$count = 1
do {
	// your code...
	$count++;
}
while($count <= $max);
		</code>
	</pre>
	<?php 
	$max = 0;
	$count = 1;
	do {
		$plural = $count > 1 ? 's' : ''; // opérateur ternaire
		echo "{$count} tour{$plural} de boucle<br>";
		$count++;
	}
	while($count <= $max);
	 ?>
	<br><br>
	<h2>La boucle FOREACH</h2>
	<p>Cette boucle spécifiquement faite pour parcourir les tableaux</p>
	<br>
	<?php 
	$array = array(
		'Nom' => 'FERU',
		'Prénom' => 'Otis',
		'genre' => 'masculin',
		'âge' => '20 ans, le reste c\'est de l\'expérience'
	);
	 ?>
	<h3>FOREACH avec value</h3>
	<br>
	<pre>
		<code>
		foreach($array as $value) {
			// your code...
		}
		</code>
	</pre>
	<?php foreach($array as $value) {
		echo $value . "<br>";
	} ?>
	<h3>FOREACH avec key => value</h3>
	<br>
	<pre>
		<code>
		foreach($array as $key => $value) {
			// your code...
		}
		</code>
	</pre>
	<?php foreach($array as $key => $value) {
		echo mb_strtoupper($key) . ' : ' . $value . "<br>";
	} ?>

</main>
<?php include __DIR__ . '/footer.php';