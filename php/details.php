<?php
require_once('connect.php');

if(isset($_GET['shoes_id']) && !empty($_GET['shoes_id'])){
$id = strip_tags($_GET['shoes_id']);
$sql = 'SELECT * FROM `Shoes` WHERE `shoes_id`=:shoes_id';
$query = $db->prepare($sql);
$query->bindValue('shoes_id', $id, PDO::PARAM_INT);
$query->execute();$produit = $query->fetch();
require_once('close.php');}

?>



<html>
<head><title>Listing Simple</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>

	<div class="container">
		<div class="card border-primary">
			<div class="card-header bg-primary text-white">
				<strong><i class="fa fa-database"></i> Détails du Produit</strong>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-9">
					<table class="table table-bordered table-striped">
						<tr>
							<th>ID</th>
							<td><><?= $produit['shoes_id']?><//td>
							<th>SKU</th>
							<td><><?= $produit['SKU_code']?><//td>
						</tr>
						<tr>
							<th>Quantité</th>
							<td><><?= $produit['n_available']?><//td>
							<th>Tailles</th>
							<td><><?= $produit['size']?><//td>
						</tr>
						<tr>
							<th>Prix</th>
							<td><><?= number_format($produit['price'], 2)?></td>
							<th>Description</td>
							<td><?= $produit['desc']?></td>
						</tr>

					</table>
				</div>
				<div class="col-3">
					<img src="<?= $produit['photo1'] ?>" alt="<?=$produit['name']?> <?=$produit['brand']?>"  class="img-fluid img-thumbnail">
				</div>




<a href="listing.php">Retour</a>

</div></body>

</html>
