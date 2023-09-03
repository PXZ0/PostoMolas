
<?php
	$pag = "finalizar_s";
	$id_orcamento = $_GET['id'];

	$query = $pdo->query("SELECT * from orcamentos WHERE id_orcamento = '$id_orcamento'");
	$res = $query->fetch(PDO::FETCH_ASSOC);

	

	if ($res['status'] == "completo"){

		$upt = $pdo->prepare("UPDATE orcamentos SET status = 'incompleto' WHERE id_orcamento = :id");
		$upt->bindValue(":id", $id_orcamento);
		$upt->execute();

		if($upt->rowCount()){
			echo('<script>window.alert("Retorno com sucesso");window.location="index.php?pagina=orcamento_adm";</script>');
		}else{
			echo('<script>window.location="index.php?pagina=orcamentos_adm";</script>');
		}

	}else{
	
		$upt = $pdo->prepare("UPDATE orcamentos SET status = 'completo' WHERE id_orcamento = :id");
		$upt->bindValue(":id", $id_orcamento);
		$upt->execute();

		if($upt->rowCount()){
			echo('<script>window.alert("Finalizado com sucesso");window.location="index.php?pagina=orcamento";</script>');
		}else{
			echo('<script>window.location="index.php?pagina=orcamentos";</script>');
		}
	}
?>