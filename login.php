<?php 
	/* SESSÃO */
	@session_start();

	/* REQUIRES */
	require_once("conexao.php");
	

	/* Variaveis */
	$usuario = $_POST['f_usuario'];
	$senha = sha1(trim($_POST['f_senha']));


	/* Busca de Usuario */
	$busca = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario and senha = :senha");

	$busca->bindValue(":usuario", $usuario);
	$busca->bindValue(":senha", $senha);

	$busca->execute();


	/* Array do Usuario */
	$usu = $busca->fetch(PDO::FETCH_ASSOC);

	if(@count($usu) > 0){

		/* Variaveis Globais */
		$_SESSION['nome_usu'] = $usu['usuario'];
		$_SESSION['nivel_usu'] = $usu['nivel'];
		$_SESSION['id_usu'] = $usu['id'];


		/* Redirecionamento */
		echo "<script language='javascript'>window.location='painel';</script>";

	}else{

		echo "<script language='javascript'>window.alert('Dados Incorretos!');</script>";

		echo "<script language='javascript'>window.location='index.php';</script>";
	}
?>