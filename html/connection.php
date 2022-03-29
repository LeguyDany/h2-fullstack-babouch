<html>

<head></head>

<body>

<?php

require('connect.php');

session_start(); // Permet de commencer une session sur notre site.

if (isset($_POST['username'])){

    // On va nettoyer le username et password en enlevant les slash. 
    $username = stripslashes($_REQUEST['username']);
    $password = stripslashes($_REQUEST['password']);

    // Commande SQL pour vérifier que l'utilisateur est dans la base de données.
    $sql = "SELECT * FROM `User_account` WHERE `username`=:username";

    $query = $db->prepare($sql); // Préparation de l'exécution de la commande SQL.
    $query->bindValue(':username', $username, PDO::PARAM_STR); // On va remplacer le paramètre ":username" à la variable $username dans la commande SQL.

    $res = $query->execute(); // Exécution de la commande SQL.
    $res = $query->fetch(); // Va chercher la prochaine ligne de commande.
    $rows = $query->rowCount(); // Vérifie qu'il n'y ait qu'une seule ligne qui a été renvoyé par la query. S'il y a aucun utilisateur, on va réaliser des actions différentes.

    if($rows==1){
        // Si l'utilisateur est bien déjà inscrit dans la base de données.

        if(password_verify($password, $res['password'])){ // On va vérifier que le mot de passe rentré ($res) correspond bien au mot de passe dans la base de données.

            $_SESSION['username'] = $username; // Ouvre une session pour l'utilisateur en question.
            header("Location: index.php"); // Redirige vers une page.

        }else{ // Dans le cas où le mot de passe rentré ne correspond pas à celle dans la base de données.
            $message="Erreur de pwd ".$password." ne vaut pas ".$res['password'];
        }

    }else{ // Si l'utilisateur n'existe pas.
        $message = "Le nom d'utilisateur n'existe pas";
    }

}

?>

<form class="box" action="" method="post" name="login">

<h1 class="box-title">Connexion</h1>

<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">

<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>


<?php if (! empty($message)) { ?> 
<!-- Si la variable $message contient quelque chose, nous donne un feedback en cas d'erreur. -->
    <p class="errorMessage"><?php echo $message; ?></p>

<?php } ?>

</form>

</body>

</html>
