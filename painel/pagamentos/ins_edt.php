<?php 

	/* REQUIRES */
	require_once("../../conexao.php");

	/* Variaveis Fomulario */
	$nome = $_POST['f_nome'];
	$id = $_POST['f_id'];


	if($id == ""){

		$ins = $pdo->prepare("INSERT INTO pagamentos SET nome = :nome");

		$ins->bindValue(":nome", $nome);

		$ins->execute();

		if($ins->rowCount()){

			echo('Salvo com Sucesso!');
			exit;

		}else{

			echo('Ocorreu um erro!');
			exit;
		}

	}else{

		$upt = $pdo->prepare("UPDATE pagamentos SET nome = :nome  WHERE id = :id");
		
		$upt->bindValue(":nome", $nome);
		$upt->bindValue(":id", $id);

		$upt->execute();

		if($upt->rowCount()){

			echo('Salvo com Sucesso!');
			exit;
			
		}else{

			echo('Ocorreu um erro!');
			exit;
		}
	}



	echo 'Salvo com Sucesso!';
?>