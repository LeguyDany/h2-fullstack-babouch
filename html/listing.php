<?php
	require_once('connect.php');
	$sql = 'SELECT * FROM `Shoes`';
	$query = $db->prepare($sql);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
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

<H1>Exemple de CRUD</H1>

<table class="table">

<?php foreach($result as $produit){?>
<tr>
	<td><?= $produit['shoes_id'] ?></td>
	<td><?= $produit['brand'] ?></td>
	<td><?= $produit['name'] ?></td>
    <td><?= $produit['price'] ?></td>
    <td><?= $produit['SKU_code'] ?></td>
    <td><?php
        $image = new Imagick();
        $image->readimageblob($produit['photo1']);
        echo '<img src="data:image/png;base64,' .  base64_encode($image->getimageblob())  . '" />';
        ?>
    </td>
	<td><a href="details.php?id=<?= $produit['id'] ?>">Voir</a>
	<td><a href="edit.php?id=<?= $produit['id'] ?>">Modifier</a>
	<td><a href="delete.php?id=<?= $produit['id'] ?>">Supprimer</a>
</tr>

<?php }?>

</table></div></body></html>
