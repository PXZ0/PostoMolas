<?php 

	/* Variaviel de Pagina */
	$pag = 'pagamentos';
	
?>

<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Nova Forma</a>

<section class="container">

	<?php 

		$busca = $pdo->query("SELECT * from pagamentos order by nome asc");
		$res = $busca->fetchAll(PDO::FETCH_ASSOC);
		$linhas = @count($res);

		if($linhas > 0){ 
			?>
			
			<small>
				<!-- TABELA - Pagamentos -->
				<table id="pagamentos" class="table table-hover my-4" style="width:100%; text-align: center;">

					<thead>
						<tr>
							<th colspan="3">
								<h3>Pagamentos</h3>
							</th>
						</tr>

						<tr>
							<th>Código</th>
							<th>Nome</th>
							<th>Ações</th>
						</tr>
					</thead>

					<tbody>

						<?php 
						for($i=0; $i < $linhas; $i++){
							foreach ($res[$i] as $key => $value){}
								
							?>

							<tr>
								<td><?php echo $res[$i]['id'] ?></td>
								<td><?php echo $res[$i]['nome'] ?></td>

								
								<td>
									<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" title="Editar Registro">
										<i class="bi bi-pencil-square text-primary"></i>
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

	if(@$_GET['funcao'] == "editar"){

		$titulo_modal = 'Editar Registro';
		$query = $pdo->query("SELECT * from pagamentos where id = '$_GET[id]'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);

		if($total_reg > 0){ 
			$nome = $res[0]['nome'];
		}

	}else{

		$titulo_modal = 'Inserir Registro';

	}
?>

<!-- MODAL - Cadastro e Edição -->
<div class="modal fade" tabindex="-1" id="modal_ce" data-bs-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title"><?php echo $titulo_modal ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form method="POST" id="form_ce" action="" name="form_ce">
				<div class="modal-body">
					
					<div class="mb-3">
						<label for="f_nome" class="form-label">Nome</label>
						<input type="text" class="form-control" id="f_nome" name="f_nome" placeholder="Nome" required="" value="<?php echo @$nome ?>">
					</div> 

					<!-- Mensagem do ajax -->
					<small><div align="center" class="mt-1" id="mensagem"></div></small>

				</div>
				
				<div class="modal-footer">

					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

					<!-- CAMPOS ESCONDIDOS -->
					<input name="f_id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				</div>

			</form>
		</div>
	</div>
</div>

<?php
	require_once('_includes/ajax.php');
?>