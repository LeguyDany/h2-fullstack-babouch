<?php

require_once('connect.php');

if(isset($_POST)){

    if(isset($_POST['shoes_id']) && !empty($_POST['shoes_id']) // Si l'id "Shoes" chosit du formulaire est null et si l'id est vide

        && isset($_POST['brand']) && !empty($_POST['brand']) // Ensuite la meme, pour les clés contenue dans l'id

        && isset($_POST['name']) && !empty($_POST['name'])

        && isset($_POST['size']) && !empty($_POST['size'])

        && isset($_POST['price']) && !empty($_POST['price'])

        && isset($_POST['desc']) && !empty($_POST['desc'])

        && isset($_POST['n_available']) && !empty($_POST['n_available'])

        && isset($_POST['photo1']) && !empty($_POST['photo1'])

        && isset($_POST['photo2']) && !empty($_POST['photo2'])

        && isset($_POST['photo3']) && !empty($_POST['photo3'])

        && isset($_POST['SKU_code']) && !empty($_POST['SKU_code'])

        && isset($_POST['add_date']) && !empty($_POST['add_date'])){

            $id = strip_tags($_GET['shoes_id']); // Supprime les balises PHP de l'id

            $produit = strip_tags($_POST['brand']);

            $prix = strip_tags($_POST['name']);

            $nombre = strip_tags($_POST['size']);

            $nombre = strip_tags($_POST['price']);

            $nombre = strip_tags($_POST['desc']);

            $nombre = strip_tags($_POST['n_available']);

            $nombre = strip_tags($_POST['photo1']);

            $nombre = strip_tags($_POST['photo2']);

            $nombre = strip_tags($_POST['photo3']);

            $nombre = strip_tags($_POST['SKU_code']);

            $nombre = strip_tags($_POST['add_date']);

            $sql = "UPDATE `liste` SET `brand`=:brand, `name`=:name, `price`=:price, `desc`=:desc, `n_available`=:n_avaible, `photo1`=:photo1, `photo2`=:photo2, `photo3`=:photo3, `SKU_code`=:SKU_code, `add_date`=:add_date WHERE `shoes_id`=:shoes_id;"; // MAJ des colonnes nombre se trouvant dans la Liste "id" de la db

            $query = $db->prepare($sql); // la variable "requete" prepare la db

            $query->bindValue(':brand', $brand, PDO::PARAM_STR);

            $query->bindValue(':name', $name, PDO::PARAM_STR);

            $query->bindValue(':size', $size, PDO::PARAM_INT);

            $query->bindValue(':price', $price, PDO::PARAM_INT);

            $query->bindValue(':desc', $desc, PDO::PARAM_STR);

            $query->bindValue(':n_available', $n_available, PDO::PARAM_INT);

            $query->bindValue(':photo1', $photo1, PDO::PARAM_LOB); // photo = de type blob

            $query->bindValue(':photo2', $photo2, PDO::PARAM_LOB);

            $query->bindValue(':photo3', $photo3, PDO::PARAM_LOB);

            $query->bindValue(':SKU_code', $SKU_code, PDO::PARAM_INT);

            $query->bindValue(':add_date', $add_date, PDO::PARAM_STR);

            $query->execute();

            header('Location: listing.php');

        }

}

if(isset($_GET['shoes_id']) && !empty($_GET['shoes_id'])){

    $id = strip_tags($_GET['shoes_id']);

    $sql = "SELECT * FROM `liste` WHERE `shoes_id`=:shoes_id;";

    $query = $db->prepare($sql);

    $query->bindValue(':shoes_id', $id, PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch();

}

require_once('close.php');

?>



<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>

    <body>
        <h1>Modifier un produit</h1>
        <form method="post">

            <p>
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" value="<?= $result['brand'] ?>">
            </p>

            <p>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= $result['name'] ?>">
            </p>

            <p>
                <label for="size">Size</label>
                <input type="number" name="size" id="size" value="<?= $result['size'] ?>">
            </p>

            <p>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" value="<?= $result['price'] ?>">
            </p>

            <p>
                <label for="desc">Description</label>
                <input type="text" name="desc" id="desc" value="<?= $result['desc'] ?>">
            </p>

            <p>
                <label for="n_available">Nombre Disponible</label>
                <input type="number" name="n_available" id="n_available" value="<?= $result['n_avaible'] ?>">
            </p>

	    <p>
		<form name="form1" action="" method="post" enctype="multipart/form-data">
		<table>
		<tr>
		<td>Select File</td>
		<td><input type="file"name="f1">
		</tr>
		<tr>
		<td><input type="submit" name="submit1" value="upload"></td>
		<td><input type="submit" name="submit2" value="display"></td>
		</tr>
		</table>
		</form>

                <label for="photo1">Photo 1</label>
                <input type="photo1" name="photo1" id="photo1" value="<?= $result['photo1'] ?>">
            </p>

            <p>
                <label for="photo2">Photo 2</label>
                <input type="photo2" name="photo2" id="photo2" value="<?= $result['photo2'] ?>">
            </p>

            <p>
                <label for="photo3">Photo 3</label>
                <input type="photo3" name="photo3" id="photo3" value="<?= $result['photo3'] ?>">
            </p>

            <p>
                <label for="SKU_code">SKU Code</label>
                <input type="SKU_code" name="SKU_code" id="SKU_code" value="<?= $result['SKU_code'] ?>">
            </p>

            <p>
                <label for="add_date">Add Date</label>
                <input type="datetime-local" name="add_date" id="add_date" value="<?= $result['add_date'] ?>">
            </p>

            <p>
                <button>Enregistrer</button>
            </p>

            <input type="hidden" name="shoes_id" value="<?= $result['shoes_id'] ?>">

        </form>

    </body>

    </html>
