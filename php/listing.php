<?php
	require_once('connect.php');

	if(isset($_POST['search']) && !empty($_POST['search'])){
		$search = strip_tags($_POST['search']);
		$sql = "SELECT * FROM `Shoes` WHERE `name` LIKE :search OR `brand` LIKE :search;";

		$query = $db->prepare($sql);

		$query->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$sql = 'SELECT * FROM `Shoes`';
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
		<strong><i class="fa fa-database"></i> Produits</strong>
	</div>



	<!-- Barre de recherche -->
	<form method="post">
		<input type="text" name="search" placeholder="Rechercher...">
		<button>Chercher</button>
	</form>
	
	<p>Résultat des recherches : <b> <?=count($result);?> paire(s)</b> dans la page.</p>



	<!-- Contenu du tableau pour les chaussures.  -->
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<h5 class="card-title float-left"></h5>
				<a href="add.php" class="btn btn-sucess float-right mb-3"><i class="fa fa-plus"></i>Add New</a>
			</div>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Nom du Produit</th>
					<th>Prix</th>
					<th>SKU</th>
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
					<td><?= $produit['SKU_code'] ?></td>
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

	<!-- Numéro de page  -->
	<?php
	// On va compter le nombre de page qu'il y a en fonction du nombre de paires de chaussure.


		if(isset($result)){
			$result_size = count($result);

			if($result_size%10 == 0){
				$page_total = floor( $result_size / 10);

			}else{
				$page_total = floor( $result_size / 10 + 1);
			}

		}

		

		for($i = 1; $i<= $page_total; $i++ ){
			echo "<a href='listing.php?current_num_page=".$i."'>".$i."</a>" ;
		}

		if(isset $_GET['current_num_page'] && !empty($_GET['current_num_page'])){
			$offset = $page_total * $_GET['current_num_page'];
			
			$search = strip_tags($_POST['search']);
			$sql = "SELECT * FROM `Shoes` WHERE `name` LIKE :search OR `brand` LIKE :search LIMIT 10 OFFSET ;";

			$query = $db->prepare($sql);

			$query->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
		}
		

	
		
	?>

	

</div>

</body>
</html>
