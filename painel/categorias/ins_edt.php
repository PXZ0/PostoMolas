<?php 

	/* REQUIRES */
	require_once("../../conexao.php");

	/* Variaveis - Formulario */
	$nome = $_POST['f_cat'];
	$id = $_POST['f_id'];

	/* Variaveis - Antigas */
	$nome_a = $_POST['f_nome_a'];


	/* Evitar Duplicidade de Nome */
	if($nome_a != $nome){

		$query_con = $pdo->prepare("SELECT * from categorias WHERE nome = :nome");

		$query_con->bindValue(":nome", $nome);

		$query_con->execute();

		$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);

		if(@count($res_con) > 0){
			echo 'Categoria já Cadastrada!';
			exit();
		}

	}


	if($id == ""){

		$res = $pdo->prepare("INSERT INTO categorias SET nome = :nome");

		$res->bindValue(":nome", $nome);

		$res->execute();

	}else{

		if($imagem != 'sem-foto.jpg'){

			$res = $pdo->prepare("UPDATE categorias SET nome = :nome, foto = :foto WHERE id = :id");

			$res->bindValue(":foto", $imagem);

		}else{

			$res = $pdo->prepare("UPDATE categorias SET nome = :nome WHERE id = :id");
		}
		
		$res->bindValue(":nome", $nome);
		$res->bindValue(":id", $id);

		$res->execute();
	}

	echo 'Salvo com Sucesso!';
?>