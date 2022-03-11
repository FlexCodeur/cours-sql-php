<?php
// pour appeler des fichiers on va avoir plusieurs méthode

// include // s'il ne trouve pas le fichier, une erreur sera déclarée mais continuera le script
// include_once // idem include mais si le fichier est déjà chargé, il ne chargera pas une seconde fois
// require // s'il ne trouve pas le fichier, il y aura une erreur fatale, donc blocage du script
// require_once // idem require mais si le fichier est déjà chargé, il ne chargera pas une seconde fois

// __DIR__ est une constante php qui donne le path serveur du dossier parent où se trouve le fichier courant
include __DIR__ . '/header.php'; ?>
<main>
	<h1>Introduction au PHP : Les variables</h1>

	<section class="intro">
		<h2>Format de variable</h2>
		<p>Dans un premier temps pour que le serveur interprête le php, celui-ci doit être enfermé dans des balises <?php echo '&lt;?php   ?&gt;'; ?></p>
		<!-- &lt; ==>  code html pour <
		&gt; ==>  code html pour > -->
		<br>
		<p>Une variable php commence par un $</p>
		<p>il ne doit pas comporter de caractères spéciaux, ni d'accents sauf le underscore</p>
		<p>la variable doit etre aussi en minuscule</p>
		<p>Pas de chiffre aussitôt le $</p>
		<p>Attention, les variables sont sensibles à la casse</p>
		<br>
		<p><code>$name_variable</code> ==> correct</p>
		<p><code>$2name_variable</code> ==> faux</p>
		<p><code>$name_variable2</code> ==> correct</p>
		<p><code>$name != $Name != $nAme</code> ==> ce sont 3 variables différentes</p>
		<br>
		<h2>Valeurs de variable PHP (types)</h2>
		<p><code>$string = 'je suis un string';</code> chaîne de caractères</p>
		<p><code>$integer = 24;</code> nombre entier</p>
		<p><code>$float = 24.59;</code> nombre relatif (décimaux)</p>
		<p><code>$boolean = TRUE;</code> booléen (vrai ou faux)</p>
		<p><code>$array = array();</code> tableau</p>
		<p><code>$object = new stdClass();</code> objet</p>
		<p><code>$null = NULL;</code> valeur nulle</p>
		<br><br>
		<br><br>
		<pre>
			<code>
				$var1 = FALSE; 
				<!-- signe "=" permet d'assigner une valeur à la variable -->
				$var2 = 0;

				$var1 == $var2 // correct
				$var1 === $var2 // faux
				$var1 != $var2 // faux car 0 == FALSE
				$var1 !== $var2 // correct ils ne sont pas strictement égaux (1 bolean et 1 integer)
			</code>
		</pre>
		<p>
			<a target="_blank" href="https://www.php.net/manual/fr/language.operators.comparison.php">Opérateurs de comparaison</a>
		</p>
		<br>
		<code>
			$first_var = 'je suis ma première variable';
			<?php $first_var = 'je suis ma première variable'; ?>
			<br>
			<?php echo $first_var; ?> 
			<!-- echo sert à afficher la variable en front (print); -->
		</code>

		<h2>Concaténation</h2>

		<p>différence entre <code>''</code>  et <code>""</code></p>
		<br>
		<?php echo '$first_var'; ?>
		<!-- considère que c'est une simple chaine de caractere -->
		<br>
		<?php echo "$first_var"; ?>
		<!-- interprete la valeur de la variable -->
		<br>
		<?php $firstname = 'Otis'; ?>
		<?php echo 'Mon prénom est ' . $firstname . '<br>'; ?>
		<?php echo "Mon prénom est $firstname<br>"; ?>
		<br>
		<br>
		<h3>Concaténation de variables</h3>
		<pre>
			<code>
		$text = '&lt;article&gt;';
		$text .= '&lt;h3&gt; test concaténation variable&lt;/h3&gt;';
		$text .= '&lt;p&gt;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum accusantium eaque consequatur sed deleniti nostrum earum veritatis voluptatibus. Esse quia rem similique et adipisci commodi accusantium sunt cupiditate autem velit?
		Quis dignissimos molestias corrupti soluta a sit voluptate ipsum nam dicta, eveniet dolor. Aperiam aspernatur officia vitae amet sequi itaque ut temporibus earum delectus quod facere, enim, iusto autem nihil.
		Obcaecati impedit odit molestias similique, laboriosam enim placeat doloribus aspernatur tenetur ea voluptatem ex corporis vel ratione minus possimus animi quasi voluptates, tempore nam eveniet ut fugiat. Suscipit atque, ex.&lt;/p&gt;';
		$text .= '&lt;/article&gt;';

		echo $text;
			</code>
		</pre>
		<?php 
		$text = '<article>';
		$text .= '<h3> test concaténation variable</h3>';
		$text .= '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum accusantium eaque consequatur sed deleniti nostrum earum veritatis voluptatibus. Esse quia rem similique et adipisci commodi accusantium sunt cupiditate autem velit?
		Quis dignissimos molestias corrupti soluta a sit voluptate ipsum nam dicta, eveniet dolor. Aperiam aspernatur officia vitae amet sequi itaque ut temporibus earum delectus quod facere, enim, iusto autem nihil.
		Obcaecati impedit odit molestias similique, laboriosam enim placeat doloribus aspernatur tenetur ea voluptatem ex corporis vel ratione minus possimus animi quasi voluptates, tempore nam eveniet ut fugiat. Suscipit atque, ex.</p>';
		$text .= '</article>';

		echo $text;

		$var1 = '5';
		$var2 = 5;
		$result = $var1 . $var2;
		echo $result; // affiche 55 ?>
		<br><br>
	<h2>Portée des variables</h2>
	<p>Les variables en PHP ont uniquement une portée de function
	</p>
	<p>exemple :</p>
	<pre>
		<code>
		$test = TRUE; // en global

		function appel_variable() { 
			$test = FALSE; // encapsulée dans la fonction
			return $test;
		}
		echo $test; // affiche TRUE
		echo appel_variable(); // affiche FALSE
			</code>
		</pre>
		<?php 
		$test = 'Otis'; // déclarée en global

		var_dump($test);

		echo '<br>';

		function appel_variable() { 
			$test = 'FERU'; // encapsulée dans la fonction
			var_dump($test);
		}

		var_dump($test);

		echo '<br>';
		echo $test; // affiche OTIS
		echo '<br>';
		echo appel_variable(); // affiche FERU
		echo '<br>';
		 ?>
		<br>
		<br>
		<h2>Les constantes</h2>
		<p><code>define('NAME', 'value');</code> // attention sensible à la casse... selon la norme, on écrit toujours une constante en majuscule</p>
		<p>Une constante est donc appelée comme ceci</p>
		<p><code>echo NAME;</code></p>
		<br>
		<p>Exemple :</p>
		<p><code>define('NOM_ECOLE', 'Campus du Lac');</code></p>
		<?php
		define('NOM_ECOLE', 'Campus du Lac');
		echo '<p><code>' . NOM_ECOLE . '</code></p>';
		?>
		<br><br>
		<h2>Les tableaux</h2>
		<h3>tableau simple</h3>
		<p>
		<code>
		$array = array('bleu', 'blanc', 'rouge');<br>
		$array = ['bleu', 'blanc', 'rouge'];<br>
		$array[0] ==> 'bleu';
		Le premier élément est 0, le second 1, etc...
		</code>
		</p>
		<?php $array = array('bleu', 'blanc', 'rouge'); ?>
		<?php $array = ['bleu', 'blanc', 'rouge']; ?>
		<?php var_dump($array); ?>
		<pre>
			<?php var_dump($array); ?>
		</pre>
		<?php 
		echo '<pre>';
		var_dump($array);
		echo '</pre>';
		?>
		<br>
		<p>Récupération de la bdd en format json</p>
		<?php 
		$result_bdd = json_encode(array('test@test.fr', 'thomas@fototoua.nul'));
		var_dump($result_bdd); ?>
		<br><br>
		<p>Remise en tableau PHP</p>
		<?php
		$array_bdd = json_decode($result_bdd);
		var_dump($array_bdd); ?>
		<br><br>
		<h3>tableau associatif</h3>
		<pre>
<code>
$array = array(
	'couleur' => 'bleu',
	'dimension' => '25m3',
	'matiere' => 'coton'
);
</code>
		</pre>
		
		<?php 
		$array = array(
			'couleur' => 'bleu',
			'dimension' => '25m3',
			'matiere' => 'coton'
		);
		var_dump($array);
		?>
		<h3>tableau multi-dimensionnel</h3>
		<?php $array = array(
			'nom' => 'FERU',
			'prenom' => 'Otis',
			'enfant' => array(
				array(
					'nom' => 'FERU',
					'prenom' => 'Dorian',
				),
				array(
					'nom' => 'FERU',
					'prenom' => 'Nala',
				),

			)
		); ?>
		<pre>
			<?php var_dump($array['enfant'][0]['prenom']); ?>
		</pre>
	</section>

</main>
<?php include __DIR__ . '/footer.php';