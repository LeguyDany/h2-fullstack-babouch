<?php
	require_once('connect.php');

	if(isset($_GET['id']) && !empty($_GET['id'])){
		
		$id = strip_tags($_GET['id']);
		$sql = 'SELECT * FROM `Shoes` WHERE `shoes_id`=:shoes_id';

		$query = $db->prepare($sql);
		$query->bindValue('shoes_id', $id, PDO::PARAM_INT);
		$query->execute();

		$produit = $query->fetch(PDO::FETCH_ASSOC);
	}

	require_once('close.php');

?>



<html>
<head><title>Listing</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>

	<div class="container">
		<div class="card border-primary">
			<div class="card-header bg-primary text-white">
			<strong><i class="fa fa-database"></i> Détails du Produit : <?= $produit['name']?></strong>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-9">
					<table class="table table-bordered table-striped">


						<tr>
							<th>ID</th>
							<td><?= $produit['shoes_id']?></td>
							<th>Marque</th>
							<td><?=$produit['brand']; ?> </td>
						</tr>
						<tr>
							<th>Quantité</th>
							<td><?= $produit['n_available']?><//td>
							<th>Tailles</th>
							<td><?= $produit['size']?><//td>
						</tr>
						<tr>
							<th>Prix (€)</th>
							<td><?= number_format($produit['price'], 2)?></td>
							<th>Description</td>
							<td><?= $produit['desc']?></td>
						</tr>
						<tr>
							<th>SKU</th>
							<td><?= $produit['SKU_code']?><//td>
							<th>Date d'ajout</th>
							<td><?=$produit['add_date']; ?> </td>
						</tr>

					</table>
				</div>
				<div class="col-3">
					<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($produit['photo1']).'" height="100" />';?>	
					<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($produit['photo2']).'" height="100" />';?>	
					<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($produit['photo3']).'" height="100" />';?>	
				</div>




		<a href="listing.php">Retour</a>

	</div>

</body>
</html>
