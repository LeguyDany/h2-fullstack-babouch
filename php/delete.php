
<?php

require_once('connect.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = strip_tags($_GET['id']);
	$sql = "DELETE FROM `Shoes` WHERE `shoes_id`=:id;";
	$query = $db->prepare($sql);
	$query->bindValue(':id', $id, PDO::PARAM_INT);
	$query->execute();
	header('Location: listing.php');
	}
require_once('close.php');
