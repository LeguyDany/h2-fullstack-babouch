<?phprequire_once('connect.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
$id = strip_tags($_GET['id']);
$sql = 'SELECT * FROM `liste` WHERE `id`=:id';
$query = $db->prepare($sql);
$query->bindValue(':id', $id, PDO::PARAM_INT);
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

<h1>Exemple de CRUD Page Detail</h1>

<table class="table">

<tr>
	<td><?= $produit['id'] ?></td>
	<td><?= $produit['produit'] ?></td>
	<td><?= $produit['prix'] ?></td>
	<td><?= $produit['nombre'] ?></td>
</tr>

</table>

<a href="listing.php">Retour</a>

</div></body>

</html>
