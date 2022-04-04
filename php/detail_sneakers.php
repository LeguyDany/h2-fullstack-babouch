<?php 

	require_once('connect.php');

	$sql = "SELECT * FROM `Shoes` WHERE `shoes_id`=:id";

	$query = $db->prepare($sql);

	$query->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
	$query->execute();

	$shoes = $query->fetch(PDO::FETCH_ASSOC);


	$sql = "SELECT * FROM `Shoes` WHERE `brand`=:brand";

	$query = $db->prepare($sql);

	$query->bindValue(':brand', $shoes['brand'], PDO::PARAM_STR);
	$query->execute();

	$recommande = $query->fetchAll(PDO::FETCH_ASSOC);

	require_once('close.php');
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/detail_sneakers.css" type="text/css" >
    <link rel="stylesheet" href="https://meyerweb.com/eric/tools/css/reset/reset.css" >
    <link rel="stylesheet" href="../assets/font/MonumentExtended-FreeForPersonalUse/MonumentExtended-Regular.otf" type="text/css">
    <link rel="stylesheet" href="../css/header.css" type="text/css" >	
    <link rel="stylesheet" href="../css/footer.css" type="text/css" >
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

    <!-- Barre de recherche et profil-->
    <div id="recherche">
	
	<!-- Barre de recherche -->
	<form method="post">
	    <input type="text" name="search"  placeholder="Chercher" id="searchbar">
	</form>

	<!-- Profil-->
	<a href="connection.php"><img src="../assets/icon/user.svg" alt="Profil"></a>

    </div>
<!--Fin barre de navigation -->
</header>





<main>
<!--    Le fond de la page-->
    <section id="un">

<!--        Le côté gauche de la page (les images)-->
        <div id="photo_sneakers1">
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($shoes['photo1']).'"/>';?> 
            <div id="photo_sneakers2">
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($shoes['photo1']).'"height="131"/>';?> 
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($shoes['photo2']).'"height="131""/>';?> 
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($shoes['photo3']).'"height="131""/>';?> 
            </div>
        </div>

<!--        Le côté droit de la page (le texte)-->
        <div>
	<h1 id="Nike"><?=$shoes['brand']?></h1>
	<h2 id="Dunk"><?=$shoes['name']?></h2>
            <hr id="Dunk">
	    <h4 id="euro"><?=$shoes['price']?>€</h4>
            <h4 id="taille">TAILLE</h4>
            <div id="taille">
                <h3>37.5</h3>
                <h3>38</h3>
                <h3>39</h3>
                <h3 id="barre">40.5</h3>
                <h3>42</h3>
            </div>
            <div id="Ajouter">
                <h3>Ajouter au panier</h3>
            </div>
            <div id="Plus">
                <p id="description">Description</p>
                <p>Authenticité</p>
                <p>Livraison</p>
            </div>
            <hr id="Plus">
            <div id="texte">
	    <p><?=$shoes['desc']?></p>
            </div>
        </div>
    </section>
    <section id="deux">
        <div id="commentaire">
            <div id="commande">
                <h2>Commande parfaite</h2>
                <p>Livraison dans les délais avec le <br>produit neuf (et sans défault)</p>
            </div>
            <div id="parfait">
                <h2>Parfait !</h2>
                <p>Commande parfaite, livré rapidement. <br> Produit conforme à la description et à nos attentes. <br> Je recommande le site !</p>
            </div>
            <div id="top">
                <h2>Commande au top</h2>
                <p>Parfait le délai de livraison est court <br> et les chaussures arrive nickel. Rien à dire</p>
            </div>
        </div>
    </section>
    <section id="trois">
	<div>

	    <h1 id="Recommandations">Recommandations . 4</h1>


	<?php for($i=1; $i < 5; $i++){ ?>
            <div id="Recommandations">
		<div id="image_1">
		    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($recommande[$i]['photo1']).'"height="136px"/>';?>
		    <h6 id="Team_red"><?=$recommande[$i]['name']?></h6>
			    <h6 id="Team_red_2">à partir de <?=$recommande[$i]['price']?>€</h6>
                </div>
	<?php } ?>
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

</main>
</body>
