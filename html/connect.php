<?php
try{
	$db = new PDO('mysql:host=localhost;dbname=Babouche','leguy_dany','root');
	$db->exec('SET NAMES "UTF8"');
} 

catch (PDOException $e){
	echo 'Erreur = ',$e->getMessage();
	die();
}

// $sql = 'SELECT name, price FROM Shoes;'
// foreach( $db->query($sql) as $row) {
// 	echo( $row['name']."-".$row['price']."<br>" );
// }

// $db = null;

?>