<?php

	/* Variaviel de Pagina */
	$pag = "clientes";

?>

<!-- Criação de novo cliente -->
<section>
	<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Novo Cliente</a>
</section>

<section class="container">

	<?php

		$busca = $pdo->query("SELECT * from clientes");

		$res = $busca->fetchAll(PDO::FETCH_ASSOC);

		$linhas = @count($res);

		if($linhas > 0){ 
			?>
			
			<small>
				<!-- TABELA - Clientes -->
				<table id=clientes class="table table-hover my-4" style="width:100%; text-align: center;">

					<thead>
						<tr>
							<th colspan="7">
								<h3>Clientes</h3>
							</th>
						</tr>

						<tr>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Celular</th>
							<th>Telefone</th>
							<th>CPF/CNPJ</th>
							<th></th>
							<th></th>
						</tr>
					</thead>

					<tbody>

						<?php 
							for($i=0; $i < $linhas; $i++){
								foreach ($res[$i] as $key => $value){}
									
								?>

								<tr>
									<td><?php echo $res[$i]['nome'] ?></td>
									<td><?php echo $res[$i]['email'] ?></td>
									<td><?php echo $res[$i]['celular'] ?></td>
									<td><?php echo $res[$i]['telefone'] ?></td>
									<td><?php echo $res[$i]['cpf_cnpj'] ?></td>

									<td>
										<a href="index.php?pagina=clientes&funcao=editar&id=<?php echo($res[$i]['id_cliente']); ?>">
											<i class="bi bi-pencil-square text-primary"></i>
										</a>
									</td>
									<td>

										<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id_cliente'] ?>" title="Excluir Registro">
											<i class="bi bi-archive text-danger mx-1"></i>
										</a>
									</td>
								</tr>

								<?php 
							} 
						?>

					</tbody>

				</table>
			</small>

			<?php 

		}else{

			echo '<p>Não existem dados para serem exibidos!!</p>';
		}
	?>

</section>

<?php 

	/* Confirmação de modal - Editar ou Cadastrar */
	if(@$_GET['funcao'] == "editar"){

		$titulo_modal = 'Editar Registro';

		$busca = $pdo-> query("SELECT * from clientes where id_cliente = $_GET[id]");

		$usus = $busca-> fetch(PDO::FETCH_ASSOC);

		$total_reg = @count($usus);

		if($total_reg > 0){ 

			$nome = $usus['nome'];
			$email = $usus['email'];
			$celular = $usus['celular'];
			$telefone = $usus['telefone'];
			$cpf_cnpj = $usus['cpf_cnpj'];

		}

	}else{

		$titulo_modal = 'Cadastrar Usuário';

	}

?>

<div class="modal fade" id="modal_ce" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
  		<form method="POST" id="form_ce" name="form_ce">
    		<div class="modal-content">
      			<div class="modal-header">

        			<h5 class="modal-title" id="staticBackdropLabel">Novo Cliente</h5>
        			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      			</div>

				<!-- formulário -->
	      		<div class="modal-body">

	      			<section class="row">

		      			<div class="col-md-12">
							<div class="mb-12">
						      	<label for="f_nome" class="form-label">Nome do Cliente ou Empresa</label>
						        <input type="text" class="form-control" id="f_nome" name="f_nome" placeholder="Nome...." required="" value="<?php echo @$nome ?>">
						        <br>
						    </div>
						</div>

					    <div class="col-md-6">
							<div class="mb-6">
						        <label for="f_celular" class="form-label">Celular</label>
						        <input type="text" class="form-control" id="f_celular" onkeypress="$(this).mask('(00) 0 0000-0000')" name="f_celular" placeholder="Celular" value="<?php echo @$celular ?>">
						    </div>
						</div>

					    <div class="col-md-6">
							<div class="mb-6">
						        <label for="f_telefone" class="form-label">Telefone</label>
						        <input type="text" class="form-control" id="f_telefone" onkeypress="$(this).mask('0000-0000')" name="f_telefone" placeholder="Telefone" value="<?php echo @$telefone ?>">
						        <br>
						    </div>
						</div>
						<div class="col-md-12">
							<div class="mb-12">
						      	<label for="f_email" class="form-label">Email</label>
						        <input type="email" class="form-control" id="f_email" name="f_email" placeholder="Digite o Email" required="" value="<?php echo @$email ?>">
						        <br>
						    </div>
						</div>
						<div class="col-md-12">
							<div class="mb-12">
						      	<label for="f_cpf_cnpj" class="form-label">CPF ou CNPJ</label>
						        <input type="text" class="form-control" id="f_cpf_cnpj" name="f_cpf_cnpj" placeholder="Digite o CPF ou CNPJ" required="" value="<?php echo @$cpf_cnpj ?>">
						        <br>
						    </div>
						</div>

						
					</section>

		    	</div>		  			

      			<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
		        	<button type="submit" name="salvar" value="salvar" class="btn btn-primary">Salvar</button>
      			</div>
    		</div>
		</form>
  	</div>
</div>

<?php
	require_once('_includes/ajax.php');
?>

<script type="text/javascript">
	$("#f_cpf_cnpj").keydown(function(){
	    try {
	        $("#f_cpf_cnpj").unmask();
	    } catch (e) {}

	    var tamanho = $("#f_cpf_cnpj").val().length;

	    if(tamanho <= 11){
	        $("#f_cpf_cnpj").mask("999.999.999-99");
	    } else {
	        $("#f_cpf_cnpj").mask("99.999.999/9999-99");
	    }

	    // ajustando foco
	    var elem = this;
	    setTimeout(function(){
	        // mudo a posição do seletor
	        elem.selectionStart = elem.selectionEnd = 10000;
	    }, 0);
	    // reaplico o valor para mudar o foco
	    var currentValue = $(this).val();
	    $(this).val('');
	    $(this).val(currentValue);
	});
</script>