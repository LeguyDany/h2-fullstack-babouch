<?php

	require_once('connect.php');

	if(isset($_POST)){

		if(isset($_POST['brand']) && !empty($_POST['brand'])
		&& isset($_POST['name']) && !empty($_POST['name'])
		&& isset($_POST['size']) && !empty($_POST['size'])
		&& isset($_POST['price']) && !empty($_POST['price'])
		&& isset($_POST['desc']) && !empty($_POST['desc'])
		&& isset($_POST['n_available']) && !empty($_POST['n_available'])
		&& isset($_FILES['photo1']) && !empty($_FILES['photo1'])
		&& isset($_FILES['photo2']) && !empty($_FILES['photo2'])
		&& isset($_FILES['photo3']) && !empty($_FILES['photo3'])
		&& isset($_POST['SKU_code']) && !empty($_POST['SKU_code'])
		){

			$brand = strip_tags($_POST['brand']);
			$name = strip_tags($_POST['name']);
			$size = strip_tags($_POST['size']);
			$price = strip_tags($_POST['price']);
			$desc = strip_tags($_POST['desc']);
			$n_available = strip_tags($_POST['n_available']);
			$photo1 = file_get_contents($_FILES['photo1']['tmp_name']);
			$photo2 = file_get_contents($_FILES['photo2']['tmp_name']);
			$photo3 = file_get_contents($_FILES['photo3']['tmp_name']);
			$SKU_code = strip_tags($_POST['SKU_code']);

			date_default_timezone_set('Europe/Paris');
			$add_date = date("Y-m-d H:i:s");

			$sql = "INSERT INTO `Shoes` (`brand`, `name`, `size`, `price`, `desc`, `n_available`, `photo1`, `photo2`, `photo3`, `SKU_code`, `add_date`) VALUES (?, ?, ?, ?, ?, ? , ? , ?, ?, ?, '$add_date');";

			$query = $db->prepare($sql);

			$query->bindValue(1, $brand, PDO::PARAM_STR);
			$query->bindValue(2, $name, PDO::PARAM_STR);
			$query->bindValue(3, $size, PDO::PARAM_INT);
			$query->bindValue(4, $price, PDO::PARAM_INT);
			$query->bindValue(5, $desc, PDO::PARAM_STR);
			$query->bindValue(6, $n_available, PDO::PARAM_INT);
			$query->bindValue(7, $photo1, PDO::PARAM_STR);
			$query->bindValue(8, $photo2, PDO::PARAM_STR);
			$query->bindValue(9, $photo3, PDO::PARAM_STR);
			$query->bindValue(10, $SKU_code, PDO::PARAM_STR);

			$query->execute();
			
			header('Location: listing.php');

		}

	}

	require_once('close.php');

?>

<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBOOLRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
	<h1>Ajouter un produit :</h1>

	<style>

		body {
		padding: 20px;
		}

		a {
		border: solid 2px #0C6EFD;
		padding: 7px;
		transition: 0.3s;
		border-radius: 5px;
		text-decoration: none;
		color: #333;
		}
		
		a:hover{
		transition: 0.3s;
		background-color: #0C6EFD;
		color: #FFF;
		}

		input{
		margin-bottom: 20px;
		width: 300px;
		}

		textarea{
		width:50vw;
		height: 10em;
		}

	</style>

	<br>
	<a href="listing.php">Retour</a>
	<br><br>
	
	<form method="post" enctype="multipart/form-data">


		<label for="brand">Marque</label>
		<br>
		<input type="text" name="brand" id="brand">
		<br>

		<label for="name">Nom de la paire</label>
		<br>
		<input type="text" name="name" id="name">
		<br>

		<label for="size">Taille</label>
		<br>
		<input type="number" name="size" id="size">
		<br>

		<label for="price">Prix</label>
		<br>
		<input type="number" name="price" id="price">
		<br>

		<label for="n_available">Quantité disponible</label>
		<br>
		<input type="number" name="n_available" id="n_available">
		<br>

		<label for="SKU_code">Code SKU</label>
		<br>
		<input type="text" name="SKU_code" id="SKU_code">
		<br>

		<label for="desc">Description</label>
		<br>
		<textarea name="desc" id="desc" rows="10" cols="30"></textarea>
		<br>

		<hr>
		<label for="photo1">Photo 1</label>
		<br>
		<input type="file" name="photo1" id="photo1">
		<br>

		<hr>
		<label for="photo2">Photo 2</label>
		<br>
		<input type="file" name="photo2" id="photo2">
		<br>

		
		<hr>
		<label for="photo3">Photo 3</label>
		<br>
		<input type="file" name="photo3" id="photo3">
		<br>

		<button class="btn btn-primary" type="button">Ajouter</button>

	</form>

</body>

</html>
