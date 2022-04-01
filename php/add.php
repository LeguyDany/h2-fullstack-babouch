<?php

require_once('connect.php');

if(isset($_POST)){

if(isset($_POST['brand']) && !empty($_POST['brand'])
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

$brand = strip_tags($_POST['brand']);
$name = strip_tags($_POST['name']);
$size = strip_tags($_POST['size']);
$price = strip_tags($_POST['price']);
$desc = strip_tags($_POST['desc']);
$n_available = strip_tags($_POST['n_available']);
$photo1 = strip_tags($_POST['photo1']);
$photo2 = strip_tags($_POST['photo2']);
$photo3 = strip_tags($_POST['photo3']);
$SKU_code = strip_tags($_POST['SKU_code']);
$add_date = strip_tags($_POST['add_date']);

$sql = "INSERT INTO `Shoes` (`brand`, `name`, `size`, `price`, `desc`, `n_available`, `photo1`, `photo2`, `photo3`, `SKU_code`, `add_date`) VALUES (:brand, :name, :size, :price, :desc, :desc, :n_available, :photo1, :photo2, :photo3, :SKU_code, :add_date);";

$query = $db->prepare($sql);

$query->bindValue(':brand', $produit, PDO::PARAM_STR);
$query->bindValue(':name', $prix, PDO::PARAM_STR);
$query->bindValue(':size', $nombre, PDO::PARAM_INT);
$query->bindValue(':price', $nombre, PDO::PARAM_INT);
$query->bindValue(':desc', $nombre, PDO::PARAM_INT);
$query->bindValue(':n_available', $nombre, PDO::PARAM_INT);
$query->bindValue(':photo1', $nombre, PDO::PARAM_INT);
$query->bindValue(':photo2', $nombre, PDO::PARAM_INT);
$query->bindValue(':photo3', $nombre, PDO::PARAM_INT);
$query->bindValue(':SKU_code', $nombre, PDO::PARAM_INT);
$query->bindValue(':add_date', $nombre, PDO::PARAM_INT);


$query->execute();

header('Location: listing.php');

}

}

require_once('close.php');

?>

<html><head></head><body>

<form method="post">


<label for="brand">Marque</label>
<input type="text" name="brand" id="brand">

<label for="name">Nom de la paire</label>
<input type="text" name="name" id="name">

<label for="size"><Taille/label>
<input type="number" name="size" id="size">

<label for="price">Prix</label>
<input type="number" name="price" id="price">

<label for="desc">Description</label>
<input type="number" name="desc" id="desc">

<label for="n_available">Quantité disponible</label>
<input type="number" name="n_available" id="n_available">

<label for="photo1">Photo 1</label>
<input type="number" name="photo1" id="photo1">

<label for="photo2">Photo 2</label>
<input type="number" name="photo2" id="photo2">

<label for="photo3">Photo 3</label>
<input type="number" name="photo3" id="photo3">

<label for="SKU_code">Code SKU</label>
<input type="number" name="SKU_code" id="SKU_code">

<label for="add_date">Date d'ajout</label>
<input type="number" name="add_date" id="add_date">


<button>Ajouter</button>

</form>

</body>

</html>
