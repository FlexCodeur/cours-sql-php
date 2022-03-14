<?php
require_once dirname(__DIR__) . '/functions.php';
var_dump($_GET);
if(isset($_GET['display']) && $_GET['display'] == 'img') {
	echo "<img src='". HOME_URL . "assets/img/star_daft.jpg'>";
}
elseif(isset($_GET['display']) && $_GET['display'] == 'text') {
	echo "Lorem ipsum, dolor sit amet, consectetur adipisicing elit. Eos minima blanditiis earum nam eum cupiditate hic repellendus voluptatum, culpa perferendis sapiente molestias veniam adipisci aliquam numquam illum totam optio fuga quas rerum unde fugiat. Ex accusantium fugit optio, pariatur neque delectus harum eum quaerat quae, minus dolorum dolor error cum voluptate natus hic accusamus inventore eveniet eos odit. Perspiciatis eum animi facere quam assumenda repellat quae nobis odio obcaecati asperiores. Vero reprehenderit odit, optio minus molestiae cumque. Possimus, repellat consectetur explicabo hic! Magnam labore, recusandae perspiciatis illo hic possimus, ducimus? Odio magnam ab atque assumenda accusantium! Quo nostrum iusto, aperiam asperiores autem corporis in, sunt consectetur expedita culpa, illum totam. Cum in omnis libero distinctio amet vero nostrum laboriosam ratione dolorum! Suscipit temporibus nemo necessitatibus magnam eaque quod nisi molestias minima asperiores quas atque dignissimos animi, natus cumque excepturi. Molestias quos quis expedita quisquam voluptatem sunt blanditiis illum nam fugiat laborum tempora, amet aperiam! Inventore cupiditate laboriosam sed expedita error ex et quos eius voluptatem autem, exercitationem maiores maxime magni molestiae, magnam deserunt velit. Quas, veritatis repellat aspernatur eos nam facilis obcaecati, a id dicta accusamus iste iure ratione ipsa blanditiis, ut qui maxime sed magnam consectetur quasi, quos deserunt.";
}



?>
<br>
<a href="<?php echo HOME_URL; ?>">Retour à la page d'accueil</a>

