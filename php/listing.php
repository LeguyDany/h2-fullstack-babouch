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

	// Compte le nombre de produits qu'il y a à afficher au total.
	if(isset($result)){
		$result_size = count($result);
	}

	// On va chercher à mettre en place une numérotation de page et à seulement afficher 10 éléments par page en fonction d'où on se situe dans la numérotation de page.
	if(isset($_GET['current_num_page']) && !empty($_GET['current_num_page']) && empty($_POST['search'])){

		$offset = 10 * $_GET['current_num_page'] - 10;

		// ==== Numérotation de page avec des mots clés entrés dans la barre de recherche. ==== //
		//if(isset($search) && !empty($search)){

		//	echo $search;
		//	$sql = "SELECT * FROM `Shoes` WHERE `name` LIKE :search OR `brand` LIKE :search LIMIT 10 OFFSET $offset;";

		//	$query = $db->prepare($sql);

		//	$query->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
		//	$query->execute();
		//	$result = $query->fetchAll(PDO::FETCH_ASSOC);
		//}else{
		
		// ==== Numérotation de page dans le cas où rien est entré dans la barre de recherche. ==== //
		$sql = "SELECT * FROM `Shoes` limit 10 OFFSET $offset;";
		$query = $db->prepare($sql);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
	}
		
	require_once('close.php');
?>


<html>
<head>
	<title>Listing Simple</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">

	<!-- Encadré au tour de la section, avec le titre.  -->
	<div class="card border-primary">
		<div class="card-header bg-primary text-white">
		<strong><i class="fa fa-database"></i>Tous les Produits</strong>

	</div>


	<!-- Contenu du tableau pour les chaussures.  -->
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<!-- Barre de recherche -->
				<nav class="navbar navbar-light">
					<form class="form-inline" method="post">
						<input class="form-control mr-sm-2" type="text" placeholder="Rechercher..." name="search" aria-label="search">
						<button class= "btn btn-outline-primary my-2 my-sm-0" type="submit">Chercher</button>
					</form>
				</nav>

	
				<p>Résultat des recherches : <b> <?=$total_shoes;?> paire(s)</b> en tout.</p>

				<!-- Affiche sur quelle page on se trouve dans la numérotation de page.  -->
				<?php 
				if($page_total - 1 > 0 && empty($_POST['search'])){ ?>
					<p>Page : <b><?=$_GET['current_num_page'];?> / <?=$page_total; ?></b></p>
				<?php } ?>

				
				<h5 class="card-title float-left"></h5>
				<a href="add.php" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i>Add New</a>
			</div>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Nom du Produit</th>
					<th>Prix</th>
					<th>Taille</th>
					<th>Quantité disponible</th>
					<th>Image</th>
					<th style="width: 20%;">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($result as $produit){?>
				<tr>
					<td><?= $produit['shoes_id'] ?></td>
					<td><?= $produit['brand'] ?></td>
					<td><?= $produit['name'] ?></td>
					<td><?= number_format($produit['price']) ?>€</td>
					<td><?= $produit['size'] ?></td>
					<td><?= $produit['n_available'] ?></td>
					<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($produit['photo1']).'" height="100" />';?></td>
					<td>
						<a href="details.php?id=<?=$produit['shoes_id']?>" class="btn btn-sm btn-light"><i class="fa fa-th-list"></i></a>
						<a href="edit.php?id=<?=$produit['shoes_id']?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
						<a href="delete.php?id=<?=$produit['shoes_id']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
		</div>
	</div>

	<!-- Numéro de page  -->
	<?php
	// On va compter le nombre de page qu'il y a en fonction du nombre de paires de chaussure.

	if($page_total - 1 > 0 && empty($_POST['search'])){
		for($i = 1; $i<= $page_total; $i++ ){
			echo "<a href='listing.php?current_num_page=".$i."'>".$i." </a>" ;
		}
	}

	?>

	<nav>
		<ul class="pagination justify-content-end">	
			<li class="page-item">
				<a href="" class="page-link"<a>
			</li>
		</ul>
	</nav>

	



			

	

</div>

</body>
</html>
