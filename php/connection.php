<?php

	require('connect.php');

	$sql = "SELECT * FROM `Images` WHERE `name` LIKE '%Connexion%'";

	$query = $db->prepare($sql);
	$query->execute();

	$img_connexion = $query->fetchAll(PDO::FETCH_ASSOC);

	session_start(); // Permet de commencer une session utilisateur sur notre site.

	if (isset($_POST['username'])){

	    // On va nettoyer le username et password en enlevant les slash. 
	    $username = stripslashes($_POST['username']);
	    $password = stripslashes($_POST['password']);
	    
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
		    header("Location: .."); // Redirige vers une page.

		}else{ // Dans le cas où le mot de passe rentré ne correspond pas à celle dans la base de données.
		    $message="Erreur de pwd ".$password." ne vaut pas ".$res['password'];
		}

	    }else{ // Si l'utilisateur n'existe pas.
		$message = "Le nom d'utilisateur n'existe pas";
	    }

	}

?>

<!-- ========== Partie html ==========  -->
<html>

	<head>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/connection.css" rel="stylesheet">
	    <title>Babouche</title>
	</head>
<body>

    <header>
        <!--Barre de navigation -->
            <!-- Image -->
            <img src="../assets/icon/LogoBlack.svg" alt="Babouch" id="logo"/>
            
            <!-- Les liens du header -->
            <div id="liens">
                <a href="accueil.php">Accueil</a>
                <a href="listing_client.php">Sneakers</a>
                <a href="">Contact</a>
            </div>

            <!-- Barre de recherche  et profil-->
            <div id="recherche">
                
                <!-- Barre de recherche -->
                <form>
                    <input type="search" placeholder="Chercher" id="searchbar">
                </form>

                <!-- Profil-->
                <a href="connection.php"><img src="../assets/icon/user.svg" alt="Profil"></a>

            </div>
        <!--Fin barre de navigation -->

    </header>


	<section id="connection">
		<!-- Image d'une paire.  -->
		<?= '<img src="data:image/jpeg;base64,'.base64_encode($img_connexion[0]['image']).'"/>' ?>

		<!-- Formulaire de connexion.  -->
		<div>
			<h1>Login</h1>

			<form method="post" name="login">

				<input type="text" name="username" placeholder="Email">
				<input type="password" name="password" placeholder="Mot de passe">

				<div>
					<div>
						<input type="checkbox" id="remember_me" name="remember_me">
						<label for="remember_me">Se souvenir de moi</label>
					</div>

					<a href="">Mot de passe oublié ?</a>
				</div>
				
				<input type="submit" value="Connexion " name="submit">

				<p>Vous n'avez pas de compte ? <a href="register.php">Commencer</a></p>

				<?php if (! empty($message)) { ?> 
					<!-- Si la variable $message contient quelque chose, nous donne un feedback en cas d'erreur. -->
					<p class="errorMessage"><?php echo $message; ?></p>
				<?php } ?>
			</form>
		</div>
	</section>


	     <!-- FOOOTER -->
     <div class="footer-container">
        <div class="footer">
            <div class="footer-heading footer-0">
                <img src="/assets/icon/LogoW.svg" alt="LogoBabouche" id="logo2"/>
                <div class="footer-rs">
                    <a href="#"><img src="/assets/icon/FbWhite.svg" alt="Fb" id=""/></a>
                    <a href="#"><img src="/assets/icon/InstaWhite.svg" alt="Insta" id=""/></a>
                    <a href="#"><img src="/assets/icon/TwitterW.svg" alt="Twitter" id=""/></a>
                </div>    
            </div>

            <div class="footer-heading footer-1">
                <h2>Infos</h2>
                <a href="#">Mon compte</a>
                <a href="#">Aides & Infos</a>
                <a href="#">Conditions d’utilisation </a>
                <a href="#">Mentions Légales</a>
                <a href="#">RGPD</a>
            </div>
            <div class="footer-heading footer-2">
                <h2>Contact</h2>
                <a href="#">Gabriel Akil</a>
                <a href="#">Noah Dahan</a>
                <a href="#">Alexandre Bellamy</a>
                <a href="#">Dany Leguy</a>
                <a href="#">Evan Thomas</a>
            </div>
            <div class="footer-heading footer-3">
                <h2>Chercher</h2>
                <a href="#">Rechercher</a>
                <a href="#">Sneakers Femme</a>
                <a href="#">Sneakers Homme</a>
                <a href="#">Prochaines Sorties</a>
            </div>
        </div>
    </div>

</body>

</html>
