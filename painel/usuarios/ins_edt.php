<?php 

	/* REQUIRES */
	require_once("../../conexao.php");
 
	/* VARIAVEIS - Formulário */
	$nome = $_POST['f_nome'];
	$email = $_POST['f_email'];
	$usuario = $_POST['f_usuario'];
	$nivel = $_POST['f_nivel'];
	$id = $_POST['f_id'];

	if($_POST['f_senha'] != ''){

		$senha = sha1(trim($_POST['f_senha']));

	}


	/* VARIAVEIS - Antigas */
	$email_a = $_POST['f_email_a'];
	$usuario_a = $_POST['f_usuario_a'];


	/* EVITAR DUPLICIDADE NO EMAIL */
	if($email_a != $email){

		$busca = $pdo->prepare("SELECT * from usuarios WHERE email = :email;");

		$busca->bindValue(":email", $email);

		$busca->execute();

		$usu = $busca->fetchAll(PDO::FETCH_ASSOC);

		if(@count($usu) > 0){

			echo 'O email do usuário já está cadastrado!';
			exit();
			
		}
	}


	/* EVITAR DUPLICIDADE NO NOME DE USUARIO */
	if($usuario_a != $usuario){

		$query_con = $pdo->prepare("SELECT * from usuarios WHERE usuario = :usuario");
		$query_con->bindValue(":usuario", $usuario);
		$query_con->execute();
		
		$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);

		if(@count($res_con) > 0){

			header('Location: index.php?pagina=usuarios');

			exit();
		}
	}


	/* Verificar se o id é nulo, caso seja sera feito o cadastro, caso não será feito a edição */
	if($id == ""){

		$res = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, usuario = :usuario, senha = :senha, nivel = :nivel");

		$res->bindValue(":nome", $nome);
		$res->bindValue(":email", $email);
		$res->bindValue(":usuario", $usuario);
		$res->bindValue(":senha", $senha);
		$res->bindValue(":nivel", $nivel);

		$res->execute();

	}else{

		if($_POST['f_senha'] != ''){

			$res = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, usuario = :usuario, senha = :senha, nivel = :nivel WHERE id = :id");

			$res->bindValue(":nome", $nome);
			$res->bindValue(":email", $email);
			$res->bindValue(":usuario", $usuario);
			$res->bindValue(":senha", $senha);
			$res->bindValue(":nivel", $nivel);
			$res->bindValue(":id", $id);

			$res->execute();

		}else{

			$res = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, usuario = :usuario, nivel = :nivel WHERE id = :id");

			$res->bindValue(":nome", $nome);
			$res->bindValue(":email", $email);
			$res->bindValue(":usuario", $usuario);
			$res->bindValue(":nivel", $nivel);
			$res->bindValue(":id", $id);

			$res->execute();
		}

	}

	echo 'Salvo com Sucesso!';
?>