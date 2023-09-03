<?php 

	/* Data e Hora */
	date_default_timezone_set('America/Sao_Paulo');	


	/* Variaveis */
	$servidor_db = "localhost";
	$usuario_db = "root";
	$senha_db = "";
	$name_db = "atm";


	/* Conexão por PDO */
	try {
		$pdo = new PDO("mysql:dbname=$name_db;host=$servidor_db;charset=utf8", "$usuario_db", "$senha_db");
	} catch (Exception $e) {
		echo 'Erro ao Conectar com o banco de dados! <p>' .$e;
	}
?>