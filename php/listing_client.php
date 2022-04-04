<?php 
	
	require_once('connect.php');

	// Place le compteur de page à 1 lorsqu'on arrive pour la sur la page.
        if(empty($_GET['current_num_page'])){
                $_GET['current_num_page'] = 1;
	}

	function num_page_total($all_products){
                // Compte le nombre total de page qu'il y aura à afficher en fonction du nombre de paires rentrées.

                $all_products_size = count($all_products);
                if($all_products_size%9 == 0){
                        $page_total = floor( $all_products_size / 9);

                }else{
                        $page_total = floor( $all_products_size / 9 + 1);
                }

                return $page_total;
        }

	// Query de la barre de recherche. Change le contenu de la query en fonction de ce qu'on entre dans la page.
        if(isset($_POST['search']) && !empty($_POST['search'])){
                $search = strip_tags($_POST['search']);
                $_GET['current_num_page'] = 1;
                $sql = "SELECT * FROM `Shoes` WHERE `name` LIKE :search OR `brand` LIKE :search;";

                $query = $db->prepare($sql);

                $query->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                $total_shoes = count($result);

                $page_total = num_page_total($result);

        // Query s'il n'y a pas de recherche effectué avec la barre de recherche.  Affiche toute la base de données pour les chaussures.
        }else{
                $sql = 'SELECT * FROM `Shoes`';
                $query = $db->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                $total_shoes = count($result);

                $page_total = num_page_total($result);
        }
	        // Compte le nombre de produits qu'il y a à afficher au total.
        if(isset($result)){
                $result_size = count($result);
        }

        // On va chercher à mettre en place une numérotation de page et à seulement afficher 10 éléments par page en fonction d'où on se situe dans la numérotation de page.
        if(isset($_GET['current_num_page']) && !empty($_GET['current_num_page']) && empty($_POST['search'])){

                $offset = 9 * $_GET['current_num_page'] - 9;

                // ==== Numérotation de page avec des mots clés entrés dans la barre de recherche. ==== //
                //if(isset($search) && !empty($search)){

                //      echo $search;
                //      $sql = "SELECT * FROM `Shoes` WHERE `name` LIKE :search OR `brand` LIKE :search LIMIT 10 OFFSET $offset;";

                //      $query = $db->prepare($sql);

                //      $query->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
                //      $query->execute();
                //      $result = $query->fetchAll(PDO::FETCH_ASSOC);
                //}else{
                
                // ==== Numérotation de page dans le cas où rien est entré dans la barre de recherche. ==== //
                $sql = "SELECT * FROM `Shoes` limit 9 OFFSET $offset;";
                $query = $db->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }



?>


<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet">
	<link href="../css/header.css" rel="stylesheet">
	<link href="../css/footer.css" rel="stylesheet">
	<link href="../css/listing_client.css" rel="stylesheet">
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
		<!-- Section filtre + listing de chaussures  -->
		<section>
			
			<!-- Titre de section  -->
			<div id="title_section">
				<h1>Sneakers</h1>
				<hr>
			</div>

			<div id="content">

				<form method="post" id="filter"> 
					
					<hr>	
					<h3>Marques</h3>
					
					<hr>	
					<h3>Prix</h3>
					
					<button>Filtrer</button>

				</form>
			
				
				<div id="listing">

				<?php foreach($result as $shoes){?>
					<div>
						<?='<img src="data:image/jpeg;base64,'.base64_encode($shoes['photo2']).'"/>' ?>
						<a href="detail_sneakers.php?id=<?=$shoes['shoes_id'] ?>"><?=$shoes['name']?></a>
						<br> <hr>
						<p>à partir de <?=$shoes['price']?> €</p>
					</div>

				<?php } ?>

				</div>


			</div>

			<div id="page_number">

				<!-- Numéro de page  -->
				<?php
				// On va compter le nombre de page qu'il y a en fonction du nombre de paires de chaussure.

				if($page_total - 1 > 0 && empty($_POST['search'])){
					for($i = 1; $i<= $page_total; $i++ ){
						if($_GET['current_num_page'] == $i){
							?>
							<a href="listing_client.php?current_num_page=<?=$i?>" style="background-color: #101EF1; color: #FFF"><p><?=$i?></p></a>
							<?php }else{
							echo "<a href='listing_client.php?current_num_page=".$i."'><p style='color: #101EF1'>".$i."</p></a>" ;

						}
					}
				}

				?>

			</div>


			

		</section>
	</main>

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
