<?php 

	/* REQUIRES */
	require_once("../../conexao.php");
 
	$nome = $_POST['f_nome'];
	$celular = $_POST['f_celular'];
	$telefone = $_POST['f_telefone'];
	$email = $_POST['f_email'];
	$cpf_cnpj = $_POST['f_cpf_cnpj'];

	// inserssão ao banco
	$sent = "liberado";
	$query = $pdo->query("SELECT * from clientes");

	while ($linha3 = $query->fetch(PDO::FETCH_ASSOC)) {
		if($linha3['cpf_cnpj'] == $cpf_cnpj){
			$sent = "bloqueado";
			echo('<script>window.alert("Cliente já cadastrado!"); window.location="index.php?pagina=clientes";</script>');

		}else{
			$sent = "liberado";
		}
	}
	if($sent == "bloqueado"){

	}else{

		/* Verificar se o id é nulo, caso seja sera feito o cadastro, caso não será feito a edição */
		if($id == ""){

			$ins = $pdo->prepare('INSERT INTO clientes SET nome = :nome, email = :email, celular = :celular, telefone = :telefone, cpf_cnpj = :cpf_cnpj;');

			$ins->bindValue(':nome', $nome);
			$ins->bindValue(':email', $email);
			$ins->bindValue(':celular',$celular);
			$ins->bindValue(':telefone', $telefone);
			$ins->bindValue(':cpf_cnpj',$cpf_cnpj);

			$ins->execute();

			if($ins->rowCount()){

				echo('<script>window.alert("Cliente cadastrado com sucesso");window.location="index.php?pagina=clientes";</script>');

			}else{

				echo('<script>window.alert("acorda animal que ta errado");window.location="index.php?pagina=clientes";</script>');

			}

		}else{

			$res = $pdo->prepare("UPDATE clientes SET nome = :nome, email = :email, celular = :celular, telefone = :telefone, cpf_cnpj = :cpf_cnpj WHERE id = :id");

			$res->bindValue(":nome", $nome);
			$res->bindValue(":email", $email);
			$res->bindValue(":celular", $celular);
			$res->bindValue(":telefone", $telefone);
			$res->bindValue(":cpf_cnpj", $cpf_cnpj);
			$res->bindValue(":id", $id);

			$res->execute();

			echo('<script>window.alert("Cliente mudado com sucesso");window.location="index.php?pagina=clientes";</script>');
		}
	}

	echo 'Salvo com Sucesso!';
?>