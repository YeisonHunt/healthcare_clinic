<?php


function Conectarse(){

	$db_host		= 'localhost';
	$db_user		= 'root';
	$db_pass		= '';
	$db_database	= 'belen_sistema_academico'; 

	try{

		$cn = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);

		$cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$cn->exec("set names utf8");

	}catch(PDOException $e){

		echo "Academic tuvo un error al conectarse a la base de datos, chequee su conexión a internet por favor...: " . $e->getMessage();

	}

	return $cn;
}
?>
