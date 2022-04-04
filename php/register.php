<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet">
		<link href="../css/register.css" rel="stylesheet">
		<title>Babouche</title>
	</head>


<body>

<?php
require('connect.php');

if (isset($_REQUEST['username'], $_REQUEST['password'])){
// Vérification, on voit  s'il y a un username, email ou password qui a été rentré dans le formulaire pour s'inscrire.

    // Les données sont ainsi stockés dans des variables.
    $username = stripslashes($_REQUEST['username']);
    $password = password_hash(stripslashes($_REQUEST['password']), PASSWORD_DEFAULT);

    var_dump($username);
    echo($username);

    // Réalisation d'une insertion en SQL pour pouvoir insérer les nouvelles données dans la base de données.
    $sql = "INSERT INTO `User_account` (`username`, `password`) VALUES (:username, :password);";

    $query = $db->prepare($sql); // Prépare l'exécution d'une commande SQL.
    // bindValue : Permet de lier une valeur à un paramètre. Entre autre, ici, on va chercher à remplacer les valeurs de la ligne 17 avec des paramètres.
    $query->bindValue(':username', $username, PDO::PARAM_STR); // Permet de lire les données SQL en string.
    $query->bindValue(':password', $password, PDO::PARAM_STR);
    // Exécute la query une fois qu'on a tout lié.

   $res = $query->execute();

    if($res){
        // Dans le cas où l'inscription s'est bien passé, on affiche un message.
	echo ("bonjour");
        echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='connection.php'>connecter</a></p>
        </div>";    
    }

}else{

?>

<section id=="inscription">
	<img src="">
	<div> 
		<h1>Inscription</h1>
		<h1>S'inscrire</h1>


		<form class="box" action="" method="post" name="register" >

   			<!-- Les différents champs. Ces champs vont pouvoir nourrir le code php plus haut. -->
    			<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
			<input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
		
 
			<input type="submit" name="submit" value="S'inscrire" class="box-button">

    			<p class="box-register">Déjà Inscrit ?<a href="connection.php">Connectez-vous ici</a></p>

		</form>
	</div>
</section>

<?php } ?>

</body>

</html>
