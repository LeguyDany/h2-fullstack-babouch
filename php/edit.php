<?php

	require_once('connect.php');

	//Query pour chercher les informations à afficher en placeholder ou preview dans la page.
	$sql = "SELECT * FROM `Shoes` WHERE `shoes_id`=?;";

	$query = $db->prepare($sql);

	$query->bindValue(1, $_GET['id'], PDO::PARAM_INT);
	$query->execute();

	$result = $query->fetchAll(PDO::FETCH_ASSOC);

	// Modification des éléments en fonction de ce qu'on a entré dans les champs.
	if(isset($_POST)){

		// Si l'utilisateur a modifié quelque chose dans le formulaire et enregistre les modifications.
		if(!empty($_POST)){

			// Query utilisé pour update la paire en question.
			$sql = "UPDATE `Shoes` SET `brand`=?, `name`=?, `size`=?, `price`=?, `desc`=?, `n_available`=?, `photo1`=?, `photo2`=?, `photo3`=?, `SKU_code`=? WHERE `shoes_id`=?;";
			$query = $db->prepare($sql);

			//Si l'utilisateur a rentré quelque chose dans le champs, sinon on garde les informations de base de la paire de chaussure. On énumère ça pour chaque paramètres de la paire.
			if(isset($_POST['brand']) && !empty($_POST['brand'])){
				$brand = strip_tags($_POST['brand']);
				$query->bindValue(1, $brand, PDO::PARAM_STR);
			}else{
				$brand = strip_tags($result[0]['brand']);
				$query->bindValue(1, $brand, PDO::PARAM_STR);
			}

			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = strip_tags($_POST['name']);
				$query->bindValue(2, $name, PDO::PARAM_STR);
			}else{
				$name = strip_tags($result[0]['name']);
				$query->bindValue(2, $name, PDO::PARAM_STR);
			} 

			if(isset($_POST['size']) && !empty($_POST['size'])){
				$size = strip_tags($_POST['size']);
				$query->bindValue(3, $size, PDO::PARAM_INT);
			}else{
				$size = strip_tags($result[0]['size']);
				$query->bindValue(3, $size, PDO::PARAM_INT);
			}

			if(isset($_POST['price']) && !empty($_POST['price'])){
				$price = strip_tags($_POST['price']);
				$query->bindValue(4, $price, PDO::PARAM_INT);
			}else{
				$price = strip_tags($result[0]['price']);
				$query->bindValue(4, $price, PDO::PARAM_INT);
			}

			if(isset($_POST['desc']) && !empty($_POST['desc'])){
				$desc = strip_tags($_POST['desc']);
				$query->bindValue(5, $desc, PDO::PARAM_STR);
			}

			if(isset($_POST['n_available']) && !empty($_POST['n_available'])){
				$n_available = strip_tags($_POST['n_available']);
				$query->bindValue(6, $n_available, PDO::PARAM_INT);
			}else{
				$n_available = strip_tags($result[0]['n_available']);
				$query->bindValue(6, $n_available, PDO::PARAM_INT);
			}

			if(file_exists($_FILES['photo1']['tmp_name']) && !empty($_FILES['photo1']['tmp_name'])){
				$photo1 = file_get_contents($_FILES['photo1']['tmp_name']);
				$query->bindValue(7, $photo1, PDO::PARAM_STR);
			}else{
				$photo1 = $result[0]['photo1'];
				$query->bindValue(7, $photo1, PDO::PARAM_STR);
			}

			if(file_exists($_FILES['photo2']['tmp_name']) && !empty($_FILES['photo2']['tmp_name'])){
				$photo2 = file_get_contents($_FILES['photo2']['tmp_name']);
				$query->bindValue(8, $photo2, PDO::PARAM_STR);
			}else{
				$photo2 = $result[0]['photo2'];
				$query->bindValue(8, $photo2, PDO::PARAM_STR);
			}

			if(file_exists($_FILES['photo3']['tmp_name']) && !empty($_FILES['photo3']['tmp_name'])){
				$photo3 = file_get_contents($_FILES['photo3']['tmp_name']);
				$query->bindValue(9, $photo3, PDO::PARAM_STR);
			}else{
				$photo3 = $result[0]['photo3'];
				$query->bindValue(9, $photo3, PDO::PARAM_STR);
			}

			if(isset($_POST['SKU_code']) && !empty($_POST['SKU_code'])){
				$SKU_code = strip_tags($_POST['SKU_code']);
				$query->bindValue(10, $SKU_code, PDO::PARAM_STR);
			}else{
				$SKU_code = strip_tags($result[0]['SKU_code']);
				$query->bindValue(10, $SKU_code, PDO::PARAM_STR);
			}

			$query->bindValue(11, $_GET['id'], PDO::PARAM_STR);
			$query->execute();

			header('Location: listing.php');

		}
        }

        require_once('close.php');
?>

<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin=" anonymous">

</head>
<body>

	<h1>Modification du produit : <?=$result[0]['name'] ?></h1>

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
		width: 50vw;
		height: 10em;
		}

        </style>
	
	<br>
        <a href="listing.php">Retour</a>
        <br><br>
        
        <form method="post" enctype="multipart/form-data">

		<label for="brand">Marque</label>
		<br>
		<input type="text" name="brand" id="brand" placeholder="<?=$result[0]['brand']?>">
		<br>

		<label for="name">Nom de la paire</label>
		<br>
		<input type="text" name="name" id="name" placeholder="<?=$result[0]['name']?>">
		<br>

		<label for="size">Taille</label>
		<br>
		<input type="number" name="size" id="size" placeholder="<?=$result[0]['size']?>">
		<br>

		<label for="price">Prix (en euros)</label>
		<br>
		<input type="number" name="price" id="price"placeholder="<?=$result[0]['price']?>">
		<br>

		<label for="n_available">Quantité disponible</label>
		<br>
		<input type="number" name="n_available" id="n_available" placeholder="<?=$result[0]['n_available']?>">
		<br>

		<label for="SKU_code">Code SKU</label>
		<br>
		<input type="text" name="SKU_code" id="SKU_code" placeholder="<?=$result[0]['SKU_code']?>">
		<br>

		<label for="desc">Description</label>
		<br>
		<textarea name="desc" id="desc" rows="10" cols="30">
		<?=$result[0]['desc']?>
		</textarea>
		<br>

		<hr>
		<label for="photo1">Photo 1</label>
		<p>Preview photo 2 :<?= '<img src="data:image/jpeg;base64,'.base64_encode($result[0]['photo1']).'" height="100" />' ?></p>
		<input type="file" name="photo1" id="photo1">
		<br>

		<hr>
		<label for="photo2">Photo 2</label>
		<p>Preview photo 2 :<?= '<img src="data:image/jpeg;base64,'.base64_encode($result[0]['photo2']).'" height="100" />' ?></p>
		<input type="file" name="photo2" id="photo2">
		<br>

		<hr>
		<label for="photo3">Photo 3</label>
		<p>Preview photo 2 :<?= '<img src="data:image/jpeg;base64,'.base64_encode($result[0]['photo3']).'" height="100" />' ?></p>
		<input type="file" name="photo3" id="photo3">
		<br>



		<button class="btn btn-primary" type="button">Enregistrer</button>

        </form>

</body>

</html>



