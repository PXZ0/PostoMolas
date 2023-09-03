<?php 

	/* REQUIRES */
	require_once("../../conexao.php");


	/* Variaveis do Fomulario */
	$nome = $_POST['f_nome'];
	$valor = $_POST['f_valor'];
	$valor = str_replace(',', '.', $valor);
	$descricao = $_POST['f_descricao'];
	$categoria = $_POST['f_categoria'];
	$dt = $_POST['f_dt'];
	$controle = $_POST['f_controle'];
	$estoque = $_POST['f_estoque'];
	$minimo = $_POST['f_minimo'];
	$id = $_POST['f_id'];

	/* Variaveis Antigas */
	$nome_a = $_POST['f_nome_a'];
	$codigo_a = $_POST['f_codigo_a'];


	/* EVITAR DUPLICIDADE NO NOME */
	if(@$nome_a != $nome){

		$query_con = $pdo->prepare("SELECT * from produtos WHERE nome = :nome");
		$query_con->bindValue(":nome", $nome);
		$query_con->execute();

		$linhas = $query_con->fetchAll(PDO::FETCH_ASSOC);

		if(@count($linhas) > 0){

			echo 'Produto já Cadastrado!';
			exit();
		}
	}


	if($controle == 1){

		if($id == ""){

			$ins = $pdo->prepare("INSERT INTO produtos SET nome = :nome, descricao = :descricao, estoque = :estoque, valor = :valor, minimo = :minimo, categoria = :categoria");

			$ins->bindValue(":nome", $nome);
			$ins->bindValue(":descricao", $descricao);
			$ins->bindValue(":valor", $valor);
			$ins->bindValue(":minimo", $minimo);
			$ins->bindValue(":categoria", $categoria);
			$ins->bindValue(":estoque", $estoque);

			$ins->execute();

			if($ins->rowCount()){

				echo('Salvo com Sucesso!');

			}else{

				echo('Ocorreu um erro!');
			}
			
		}else{

			$dt = NULL;

			$upt = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, estoque = :estoque, valor = :valor, minimo = :minimo, categoria = :categoria, dt_val = :data WHERE id = :id");

			$upt->bindValue(":nome", $nome);
			$upt->bindValue(":descricao", $descricao);
			$upt->bindValue(":valor", $valor);
			$upt->bindValue(":minimo", $minimo);
			$upt->bindValue(":categoria", $categoria);
			$upt->bindValue(":estoque", $estoque);
			$upt->bindValue(":id", $id);
			$upt->bindValue(':data', $dt);

			$upt->execute();
			
			if($upt->rowCount()){

				echo('Salvo com Sucesso!');

			}else{

				echo('Ocorreu um erro!');
			}
		}

	}else{

		if($id == ""){

			$ins = $pdo->prepare("INSERT INTO produtos SET nome = :nome, descricao = :descricao, estoque = :estoque, valor = :valor, minimo = :minimo, categoria = :categoria, dt_val = :data");

			$ins->bindValue(":nome", $nome);
			$ins->bindValue(":descricao", $descricao);
			$ins->bindValue(":valor", $valor);
			$ins->bindValue(":minimo", $minimo);
			$ins->bindValue(":categoria", $categoria);
			$ins->bindValue(":data",$dt);
			$ins->bindValue(":estoque", $estoque);

			$ins->execute();

			if($ins->rowCount()){

				echo('Salvo com Sucesso!');

			}else{

				echo('Ocorreu um erro!');
			}
			
		}else{

			$upt = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, estoque = :estoque, valor = :valor, minimo = :minimo, categoria = :categoria, dt_val = :data WHERE id = :id");

			$upt->bindValue(":nome", $nome);
			$upt->bindValue(":descricao", $descricao);
			$upt->bindValue(":valor", $valor);
			$upt->bindValue(":minimo", $minimo);
			$upt->bindValue(":categoria", $categoria);
			$upt->bindValue(':data', $dt);
			$upt->bindValue(":estoque", $estoque);
			$upt->bindValue(":id", $id);

			$upt->execute();
			
			if($upt->rowCount()){

				echo('Salvo com Sucesso!');

			}else{

				echo('Ocorreu um erro!');
			}
		}
	}
?>