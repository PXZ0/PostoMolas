<?php

	/* Variaviel de Identificação de Pagina */
	$pag = "n_orcamento";

	$id_orcamento = $_GET['id'];
	
?>

<!-- Abertura dos Modais -->
<br>
<section style="text-align: center;" class="container">

	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert_p">
	  Produtos
	</button>

	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert_s">
	  Serviços
	</button>

</section>


<!-- TABELAS - Produtos -->
<section>
	<table id="produtos" name="produtos" class="table table-hover my-4" style="width:100%; text-align: center;">

		<thead>
			<tr>
				<th colspan="7">
					<h3>
						Produtos
					</h3>
				</th>
			</tr>

			<tr>
				<th>Produto</th>
				<th>Quantidade</th>
				<th>Total</th>
				<th>Ações</th>
			</tr>
		</thead>

		<tbody>
			<?php

				$busca = $pdo->query("SELECT * from produtos_vnd where id_orcamento = $id_orcamento");

				while ($prodv = $busca->fetch(PDO::FETCH_ASSOC)) {

					$id = $prodv['id_prod'];

					?>
						<tr>
							<td>
								<?php 

									/* Busca de Dados do produto */
									$busca = $pdo->query("SELECT * from produtos where id = $id");

									$prod = $busca->fetch(PDO::FETCH_ASSOC);

									echo($prod['nome']) ;
								?>
							</td>

							<td>
								<?php echo($prodv['quantidade']) ?>
							</td>

							<td>
								<?php echo($prodv['total']) ?>
							</td>

							<td>
								<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar_p&id=<?php echo $prodv['id_vnd'] ?>" title="Editar Registro">
									<i class="bi bi-pencil-square text-primary"></i>
								</a>

								<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $prod['id'] ?>" title="Excluir Registro">
									<i class="bi bi-archive text-danger mx-1"></i>
								</a>
							</td>
						</tr>
					<?php
				}
			?>
		</tbody>
	</table>
</section>


<!-- TABELAS - Serviços -->
<section>
	<table id="servicos" name="servicos" class="table table-hover my-4" style="width:100%; text-align: center;">

		<thead>
			<tr>
				<th colspan="7">
					<h3>
						Serviços
					</h3>
				</th>
			</tr>

			<tr>
				<th>Serviço</th>
				<th>Descrição</th>
				<th>Preço</th>
				<th>Ações</th>
			</tr>
		</thead>

		<tbody>
			<?php

				$busca = $pdo->query("SELECT * from servicos where id_orcamento = $id_orcamento");

				while ($serv = $busca->fetch(PDO::FETCH_ASSOC)) {
					?>
						<tr>
							<td>
								<?php 
									echo($serv['servico']) ;
								?>
							</td>

							<td>
								<?php echo($serv['descricao']) ?>
							</td>

							<td>
								<?php echo($serv['preco']) ?>
							</td>

							<td>
								<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar_s&id=<?php echo $prod['id'] ?>" title="Editar Registro">
									<i class="bi bi-pencil-square text-primary"></i>
								</a>

								<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $prod['id'] ?>" title="Excluir Registro">
									<i class="bi bi-archive text-danger mx-1"></i>
								</a>
							</td>
						</tr>
					<?php
				}
			?>
		</tbody>
	</table>
</section>

<?php

	if(@$_GET['funcao'] == "editar_p"){

		$titulo_modal = 'Editar Registro';

		$query = $pdo->query("SELECT * from produtos_vnd where id_vnd = ".$_GET['id']);

		$prodv = $query->fetch(PDO::FETCH_ASSOC);

		$linhas = @count($prodv);

		if($linhas > 0){ 

			$query = $pdo->query("SELECT * from produtos where id = ".$prodv['id_prod']);

			$prodv = $query->fetch(PDO::FETCH_ASSOC);

			$nome = $prodv['nome'];

			?>

			<script type="text/javascript">

				var myModal = new bootstrap.Modal(document.getElementById('insert_p'), {
					backdrop: 'static'
				})

				myModal.show();
				
			</script>

			<?php

		}

	}else if(@$_GET['funcao'] == "editar_f"){

		$titulo_modal = 'Editar Registro';

		$query = $pdo->query("SELECT * from servicos where id = '$_GET[id]'");

		$serv = $query->fetch(PDO::FETCH_ASSOC);

		$linhas = @count($serv);

		if($linhas > 0){ 

			$nome = $serv['nome'];

			?>

			<script type="text/javascript">
				var myModal = new bootstrap.Modal(document.getElementById('insert_s'), {
					backdrop: 'static'
				})

				myModal.show();
			</script>

			<?php
		}
		
	}

	if(isset($_POST['salvar'])){

		/* Variaveis do Formulario */
		$valor = $_POST['f_peca'];
		$quantidade = $_POST['f_quantidade'];

		/* Busca de Produtos no Banco */
		$busca = $pdo->query("SELECT * FROM produtos WHERE nome = '$valor'");

		$prod = $busca->fetch(PDO::FETCH_ASSOC);

		$total = $quantidade * $prod['valor'];


		/* Verificação de quantidade */
		if($prod['estoque'] >= $quantidade){

			/* Numero de Peças no estoque */
			$n_estoque = $prod['estoque'] - $quantidade;


			/* Insert nos Produtos Vendidos */
			$ins = $pdo->prepare("INSERT INTO produtos_vnd SET id_prod = :id_prod, quantidade = :quantidade, total = :total, id_orcamento = :id_orcamento");

			$ins->bindValue(":id_prod", $prod['id']);
			$ins->bindValue(":quantidade", $quantidade);
			$ins->bindValue(":total", $total);
			$ins->bindValue(":id_orcamento", $id_orcamento);
			
			$ins->execute();
			
			/* Verificação de Inserção */
			if($ins->rowCount()){
				
				/* Alterar Estoque Após a Venda */
				$upt = $pdo->prepare("UPDATE produtos SET estoque = :estoque WHERE id = :id");

				$upt->bindValue(":estoque", $n_estoque);
				$upt->bindValue(":id", $prod['id']);

				$upt->execute();

				if($upt->rowCount()){

					echo("<script> window.location='index.php?pagina=".$pag."&id=".$id_orcamento."';</script>");
				}

			}else{

				echo('<script>window.alert("Ocorreu um erro ao cadastrar a venda!");</script>');	
			}

		}else{

			echo('<script>window.alert("estoque insuficiente");</script>');
		}
		
	}

	if(isset($_POST['salvar_serv'])){

		/* Variaveis do Formulario */
		$servico = $_POST['f_tipo_serv'];
		$valor = str_replace(',', '.', $_POST['f_valor']);
		$descricao = $_POST['f_descricao'];


		/* Insert de servicos */
		$ins = $pdo->prepare("INSERT INTO servicos SET servico = :servico, descricao = :descricao, preco = :preco, id_orcamento = :id_orcamento");

		$ins->bindValue(":servico", $servico);
		$ins->bindValue(":descricao", $descricao);
		$ins->bindValue(":preco", $valor);
		$ins->bindValue(":id_orcamento", $id_orcamento);
		
		$ins->execute();

		if($ins->rowCount()){

			echo("<script> window.location='index.php?pagina=".$pag."&id=".$id_orcamento."';</script>");

		}else{

			echo('<script>window.alert("Ocorreu um erro ao cadastrar o orçamento!");</script>');	
		}

	}

	require_once('_includes/ajax.php');
?>



<!-- Modal Produtos -->
<div class="modal fade" id="insert_p" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 	<div class="modal-dialog">
		<div class="modal-content">

  			<div class="modal-header">
    			<h5 class="modal-title" id="staticBackdropLabel">Produtos</h5>
    			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  			</div>

			<!-- formulário -->
	      	<form method="POST" id="form-peca">
		    	<div class="modal-body">

		      		<label for="produtos" class="form-label">Produtos Cadastrados </label>
		        	<input list="PC" name="f_peca" id="produtos" placeholder="Nome da peça">

					<datalist id="PC">
					
			        	<?php

							$sql = $pdo->query("SELECT * FROM produtos");
							while($linha = $sql->fetch(PDO::FETCH_ASSOC)){
								echo('<option value="'.$linha['nome'].'">'.$linha['nome'].'<option>');
							}

						?>

					</datalist>

					<div class="col-md-4">
						<div class="mb-3">
							<label for="f_quantidade" class="form-label">quantidade</label>
							<input type="number" class="form-control" id="f_quanttidade" name="f_quantidade" placeholder="Quantidade" value="1">
						</div> 
					</div>
			    </div>
				

      			<div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="submit" name="salvar" value="salvar" class="btn btn-primary">Adicionar</button>
		      	</div>
    		</div>
		</form>
  	</div>
</div>

<!-- Modal Serviços -->
<div class="modal fade" id="insert_s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">  		
   		<div class="modal-content">

   			<div class="modal-header">
        		<h5 class="modal-title" id="staticBackdropLabel">Adicionar Serviço</h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>

      		<form method="POST" id="form-servico">

      			<div class="modal-body">
      				<section class="row">

	      				<div class="col-md-8">
							<div class="mb-7">
								<label for="f_tipo_serv" class="form-label">Tipo de Serviço</label>
								<input type="text" class="form-control" id="f_tipo_serv" name="f_tipo_serv" placeholder="Nome do Serviço prestado">
							</div> 
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label for="f_valor" class="form-label">Valor do serviço</label>
								<input type="text" class="form-control" id="f_valor" name="f_valor" placeholder="00,00" onkeyup="formatarMoeda()">
							</div> 
						</div>

					</section>
				</div>

				<div class="col-md-12">
					<div class="mb-12">
						<label for="f_descricao" class="form-label">Descrição</label>
						<input type="text" class="form-control" id="f_descricao" name="f_descricao" placeholder="Breve descrição do serviço...." maxlength="250">
					</div> 
				</div>

		      	<div class="modal-footer">
			    	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			    	<button type="submit" name="salvar_serv" value="salvar" class="btn btn-primary">Adicionar</button>
			    </div>
    		
			</form>
		</div>
	</div>
</div>


<!----------------- formatação de moeda ------------>

<script type="text/javascript">
	function formatarMoeda() {
        var elemento = document.getElementById('f_valor');
        var valor = elemento.value;
        

        valor = valor + '';
        valor = parseInt(valor.replace(/[\D]+/g, ''));
        valor = valor + '';
        valor = valor.replace(/([0-9]{2})$/g, ",$1");

        if (valor.length > 6) {
            valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }

        elemento.value = valor;
        if(valor == 'NaN') elemento.value = '';
        
    }
</script>