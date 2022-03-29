<html>
<head></head>
<body>

<?php
require('connect.php');

if (isset($_REQUEST['username'], $_REQUEST['password'])){
// Vérification, on voit  s'il y a un username, email ou password qui a été rentré dans le formulaire pour s'inscrire.

    // Les données sont ainsi stockés dans des variables.
    $username = stripslashes($_REQUEST['username']);
    $password = password_hash(stripslashes($_REQUEST['password']), PASSWORD_DEFAULT);

    // Réalisation d'une insertion en SQL pour pouvoir insérer les nouvelles données dans la base de données.
    $sql = "INSERT INTO User_account(username, password) VALUES(:username, :password);";

    $query = $db->prepare($sql); // Prépare l'exécution d'une commande SQL.
    // bindValue : Permet de lier une valeur à un paramètre. Entre autre, ici, on va chercher à remplacer les valeurs de la ligne 17 avec des paramètres.
    $query->bindValue('username', $username, PDO::PARAM_STR); // Permet de lire les données SQL en string.
    $query->bindValue('password', $password, PDO::PARAM_STR);
    var_dump($query);
    echo('<br>');
    // Exécute la query une fois qu'on a tout lié.
    $res = $query->execute();
    var_dump($res);

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

<!-- Formulaire où on va rentrer les informations pour s'enregistrer. -->
<form class="box" action="" method="post">

    <h1 class="box-logo box-title">Inscription</a></h1>
    <h1 class="box-title">S'inscrire</h1>

    <!-- Les différents champs. Ces champs vont pouvoir nourrir le code php plus haut. -->
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />

    <p class="box-register">Déjà inscrit? <a href="connection.php">Connectez-vous ici</a></p>

</form>

<?php } ?>

</body>

</html>
