<?php 
	
	require_once('connect.php');

	// Place le compteur de page à 1 lorsqu'on arrive pour la sur la page.
        if(empty($_GET['current_num_page'])){
                $_GET['current_num_page'] = 1;
	}

	function num_page_total($all_products){
                // Compte le nombre total de page qu'il y aura à afficher en fonction du nombre de paires rentrées.

                $all_products_size = count($all_products);
                if($all_products_size%10 == 0){
                        $page_total = floor( $all_products_size / 10);

                }else{
                        $page_total = floor( $all_products_size / 10 + 1);
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
	
	


?>


<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet">
	<link href="../css/listing_client.css" rel="stylesheet">
	<title>Babouche</title>
</head>

<body>

	<header>
	<!--Barre de navigation -->
	    <!-- Image -->
	    <img src="/assets/image/icon/LogoBlack.svg" alt="Babouch" id="logo"/>
	    
	    <!-- Les liens du header -->
	    <div id="liens">
		<a href="">Sneakers</a>
		<a href="">Découvrir</a>
		<a href="">Nouveautés</a>
	    </div>

	    <!-- Barre de recherche  et profil-->
	    <div id="recherche">
		
		<!-- Barre de recherche -->
		<form>
		    <input type="text" name="search"  placeholder="Chercher" id="searchbar">
		</form>

		<!-- Profil-->
		<a href=""><img src="/assets/image/icon/user.svg" alt="Profil"></a>

	    </div>
	<!--Fin barre de navigation -->
	</header>



	<!-- Section filtre + listing de chaussures  -->
	<section>
		
		<!-- Titre de section  -->
		<div id="title_section">
			<h1>Nos sneakers</h1>
			<hr>	
		</div>

		<div id="filtre"> 

		</div>
	
		
		<div id="listing">
			
		</div>


	</section>


</body>

</html>
