<?php 

	/* Variavel de Identificação de Pagina */
	$pag = 'categorias';

?>

<!-- Botão para nova categoria -->
<section>
	<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Nova Categoria</a>
</section>

<section class="container">

	<?php 

		/* Busca de Categorias */
		$query = $pdo->query("SELECT * from categorias order by id desc");

		$cat = $query->fetchAll(PDO::FETCH_ASSOC);

		$linhas = @count($cat);


		/* Verificação de Existencia de Registro */
		if($linhas > 0){ 

			?>

			<small>

				<!-- TABELA - Categorias -->
				<table id="example" class="table table-hover my-4" style="width:100%; text-align: center;">
					
					<thead>
						<tr>
							<th colspan="3">
								<h3> Categorias </h3>
							</th>
						</tr>

						<tr>
							<th>Nome</th>
							<th>Produtos</th>
							<th>Ações</th>
						</tr>
					</thead>

					<tbody>

						<?php

							for($i=0; $i < $linhas; $i++){

								foreach ($cat[$i] as $key => $value){}

								$id_cat = $cat[$i]['id'];

								$busca = $pdo->query("SELECT * from produtos where categoria = '$id_cat'");

								$cat_p = $busca->fetchAll(PDO::FETCH_ASSOC);
								
								$produtos = @count($cat_p);

								?>

								<tr>
									<td><?php echo $cat[$i]['nome'] ?></td>

									<td><?php echo $produtos ?></td>

									<td>
										<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $cat[$i]['id'] ?>" title="Editar Registro">
											<i class="bi bi-pencil-square text-primary"></i>
										</a>

										<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $cat[$i]['id'] ?>" title="Excluir Registro">
											<i class="bi bi-archive text-danger mx-1"></i>
										</a>

										<a href="index.php?pagina=prod_categoria&produ=true&categoria=<?php echo($cat[$i]['id']); ?>" title="Visualizar">

											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">

											  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>

											  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>

											</svg>
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

			echo ('<p>Não existem dados para serem exibidos!!');
		} 

	?>
</section>


<?php 
	if(@$_GET['funcao'] == "editar"){

		$titulo_modal = 'Editar Registro';

		$query = $pdo->query("SELECT * from categorias where id = '$_GET[id]'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$linhas = @count($res);

		if($linhas > 0){ 
			$nome = $res[0]['nome'];
		}

	}else{

		$titulo_modal = 'Inserir Registro';
	}
?>

<!-- MODAIS -->

<!-- MODAL - Cadastrar e Editar -->
<div class="modal fade" tabindex="-1" id="modal_ce" data-bs-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title"><?php echo $titulo_modal ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- FORMULARIO - Cadastro e Edição -->
			<form name="form_ce" method="POST" action="" id="form_ce">
				<div class="modal-body">
					
					<div class="mb-3">
						<label for="f_nome" class="form-label">Nome</label>
						<input type="text" class="form-control" id="f_nome" name="f_cat" placeholder="Nome" required="" value="<?php echo @$nome ?>">
					</div> 
					
					<small><div align="center" class="mt-1" id="mensagem"></div></small>

				</div>

				<div class="modal-footer">

					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

					<!-- CAMPOS ESCONDIDOS -->
					<input name="f_id" type="hidden" value="<?php echo @$_GET['id'] ?>">
					<input name="f_nome_a" type="hidden" value="<?php echo @$nome ?>">

				</div>
			</form>			
		</div>
	</div>
</div>


<?php
	require_once('_includes/ajax.php');
?>