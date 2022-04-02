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
		&& isset($_POST['add_date']) && !empty($_POST['add_date'])
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
			$add_date = strip_tags($_POST['add_date']);

			//var_dump ($_FILES['photo1']);
			//$test = mysql_real_escape_string(file_get_contents($_FILES["photo1"]["tmp_name"]));
			//echo($test);
			//echo("<br>");
			//echo(phpinfo());
			//var_dump($_FILES['photo1']);
			//echo("<br>");
			//echo($photo1);

			$sql = "INSERT INTO `Shoes` (`brand`, `name`, `size`, `price`, `desc`, `n_available`, `photo1`, `photo2`, `photo3`, `SKU_code`, `add_date`) VALUES (:brand, :name, :size, :price, :desc, :desc, :n_available, :photo1, :photo2, :photo3, :SKU_code, :add_date);";

			$query = $db->prepare($sql);

			$query->bindValue(':brand', $brand, PDO::PARAM_STR);
			$query->bindValue(':name', $name, PDO::PARAM_STR);
			$query->bindValue(':size', $size, PDO::PARAM_INT);
			$query->bindValue(':price', $price, PDO::PARAM_INT);
			$query->bindValue(':desc', $desc, PDO::PARAM_STR);
			$query->bindValue(':n_available', $n_available, PDO::PARAM_INT);
			$query->bindValue(':photo1', $photo1, PDO::PARAM_LOB);
			$query->bindValue(':photo2', $photo2, PDO::PARAM_LOB);
			$query->bindValue(':photo3', $photo3, PDO::PARAM_LOB);
			$query->bindValue(':SKU_code', $SKU_code, PDO::PARAM_STR);
			$query->bindValue(':add_date', $add_date, PDO::PARAM_STR);


			$query->execute();

			//header('Location: listing.php');

		}

	}

	require_once('close.php');

?>

<html><head></head><body>


	<form method="post" enctype="multipart/form-data">


		<label for="brand">Marque</label>
		<input type="text" name="brand" id="brand">
		<br>

		<label for="name">Nom de la paire</label>
		<input type="text" name="name" id="name">
		<br>

		<label for="size">Taille</label>
		<input type="number" name="size" id="size">
		<br>

		<label for="price">Prix</label>
		<input type="number" name="price" id="price">
		<br>

		<label for="desc">Description</label>
		<input type="text" name="desc" id="desc">
		<br>

		<label for="n_available">Quantité disponible</label>
		<input type="number" name="n_available" id="n_available">
		<br>

		<label for="photo1">Photo 1</label>
		<input type="file" name="photo1" id="photo1">
		<br>

		<label for="photo2">Photo 2</label>
		<input type="file" name="photo2" id="photo2">
		<br>

		<label for="photo3">Photo 3</label>
		<input type="file" name="photo3" id="photo3">
		<br>

		<label for="SKU_code">Code SKU</label>
		<input type="text" name="SKU_code" id="SKU_code">
		<br>

		<label for="add_date">Date d'ajout</label>
		<input type="text" name="add_date" id="add_date">
		<br>

		<button>Ajouter</button>

	</form>

</body>

</html>
