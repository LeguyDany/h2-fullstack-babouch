<?php
try{
	$db = new PDO('mysql:host=localhost:3306;dbname=Babouche','leguy_dany','root');
	$db->exec('SET NAMES "UTF8"');
	} 

catch (PDOException $e){
	echo 'Erreur = ',$e->getMessage();
	die();
	}
