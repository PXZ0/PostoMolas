<?php 

	/* Variavel de Identificação da Página*/
	$pag = 'produtos';
	
?>

<!-- Botão para inserir novo produto -->
<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Novo Produto</a>

<section class="container">

	<?php 

		/* Busca de Produtos */
		$query = $pdo->query("SELECT * from produtos order by id");

		$prod = $query->fetchAll(PDO::FETCH_ASSOC);

		$linhas = @count($prod);

		/* Verificação de Existencia de Dados */
		if($linhas > 0){ 

			?>
			<small>

				<!-- TABELA - Produtos -->
				<table id="example" class="table table-hover my-4" style="width:100%; text-align: center;">

					<thead>
						<tr>
							<th colspan="7">
								<h3>
									Produtos
								</h3>
							</th>
						</tr>

						<tr>
							<th>Código</th>
							<th>Nome</th>			
							<th>Estoque</th>
							<th>Quantidade Min</th>
							<th>Valor Venda</th>
							<th>Validade</th>
							<th>Ações</th>
						</tr>

					</thead>

					<tbody>

						<?php 

							for($i=0; $i < $linhas; $i++){

								foreach ($prod[$i] as $key => $value){}

								$id_cat = $prod[$i]['categoria'];

								$busca = $pdo->query("SELECT * from categorias where id = '$id_cat'");

								$cat = $busca->fetch(PDO::FETCH_ASSOC);

								$nome_cat = $cat['nome'];

								?>

								<tr>

									<td><?php echo $prod[$i]['id'] ?></td>							

									<td><?php echo $prod[$i]['nome'] ?></td>

									

									<td>
										<?php

											if($prod[$i]['minimo']<$prod[$i]['estoque']){

												echo('<p style="color: #006400;">'.number_format($prod[$i]["estoque"]).'</p>');
											}else{

												echo('<p style="color: #f00;">'.number_format($prod[$i]["estoque"]).'</p>');
											}
										?>
											
									</td>

									<td><?php echo (number_format($prod[$i]['minimo'])); ?></td>
									
									<td>R$ <?php echo (number_format($prod[$i]['valor'], 2, ',', '.')); ?></td>

									<td>
										<?php 
											$dt_fin=implode("/",array_reverse(explode("-",$prod[$i]['dt_val'])));

											if($dt_fin==null){
												echo("Sem data de validade");
											}else{
												echo $dt_fin;
											}
										?>										
									</td>
									
									<td>
										<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $prod[$i]['id'] ?>" title="Editar Registro" style="text-decoration: none">
											<i class="bi bi-pencil-square text-primary"></i>
										</a>

										<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $prod[$i]['id'] ?>" title="Excluir Registro" style="text-decoration: none">
											<i class="bi bi-archive text-danger mx-1"></i>
										</a>

										<a href="#" onclick = "mostrarDados('<?php echo $prod[$i]['nome'] ?>', '<?php echo $prod[$i]['descricao'] ?>', '<?php echo $nome_cat ?>')" title="Ver Descriçao" style="text-decoration: none">

											<i class="bi bi-card-text text-dark mx-1"></i>
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
			echo '<p>Não existem dados para serem exibidos!!';
		} 
	?>
</section>


<?php 

	if(@$_GET['funcao'] == "editar"){

		$titulo_modal = 'Editar Registro';

		$query = $pdo->query("SELECT * from produtos where id = '$_GET[id]'");

		$prod = $query->fetch(PDO::FETCH_ASSOC);

		$total_reg = @count($prod);

		if($total_reg > 0){ 
			$nome = $prod['nome'];
			$categoria = $prod['categoria'];
			$minimo = $prod['minimo'];
			$descricao = $prod['descricao'];
			$estoque = $prod['estoque'];
			$validade = $prod['dt_val'];
			$valor_venda = $prod['valor'];
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

			<!-- FORMULARIO - Cadastro e Edição -->
			<form name="form_ce" method="POST" id="form_ce" action="index.php?pagina=produtos">

				<div class="modal-body">

					<section class="row">

						<div class="col-md-6">
							<div class="mb-3">
								<label for="f_nome" class="form-label">Nome</label>
								<input type="text" class="form-control" id="f_nome" name="f_nome" placeholder="Nome" required="" value="<?php echo @$nome ?>"/>
							</div> 
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="f_categoria" class="form-label">Categoria</label>
								<select class="form-select mt-1" aria-label="Default select example" id="f_categoria" name="f_categoria"/>

									<?php

									/* Busca de Categorias */
									$query = $pdo->query("SELECT * from categorias order by nome asc");

									$categoria = $query->fetchAll(PDO::FETCH_ASSOC);

									$linhas = @count($categoria);

									if($linhas > 0){ 

										for($i=0; $i < $linhas; $i++){
											foreach ($categoria[$i] as $key => $value){	}
												?>

											<option <?php if(@$categoria == $categoria[$i]['id']){ ?> selected <?php } ?>  value="<?php echo $categoria[$i]['id'] ?>"><?php echo $categoria[$i]['nome'] ?></option>

										<?php }

									}else{ 

										echo '<option value="">Cadastre uma Categoria</option>';

									} ?>
								</select>
							</div> 
						</div>						
					</section>

					<div class="mb-3">
						<label for="f_descricao" class="form-label">Descrição do Produto</label>
						<textarea type="text" class="form-control" id="f_descricao" name="f_descricao" maxlength="200"><?php echo @$descricao ?></textarea>
					</div> 
					
					<section class="row">

						<div class="col-md-4">
							<div class="mb-3">
								<label for="f_estoque" class="form-label">Estoque</label>
								<input type="number" class="form-control" id="f_estoque" name="f_estoque" placeholder="Estoque" required="" value="<?php echo @$estoque ?>"/>
							</div> 
						</div>

						<div class="col-md-4">
							<div class="mb-3">
								<label for="f_minimo" class="form-label">Quantidade Minima</label>
								<input type="number" class="form-control" id="f_minimo" name="f_minimo" placeholder="Minimo" required="" value="<?php echo @$minimo ?>"/>
							</div> 
						</div>
						
						

					
					
					<div class="col-md-4">
						<div class="mb-3">
							<label for="f_valor" class="form-label">Valor Venda</label>
							<input type="text" class="form-control" id="f_valor" name="f_valor" placeholder="valor da venda" required="" value="<?php echo @$valor_venda ?>"/ onkeyup="formatarMoeda()">
						</div> 
					</div>
						</section>
					<br/>

					<section>

						<p>Assinale a alternativa que identifique o produto posteriomente</p>

						<div class="form-check ">
						  <input class="form-check-input" type="radio" name="f_controle" id="controle1" value="0" <?php if(@$validade != null){ echo'checked'; } ?>>
						  <label class="form-check-label" for="controle1">
						  	Com data de validade						  			
						  </label>
						</div>

						<div class="form-check">
						  <input class="form-check-input" type="radio" name="f_controle" value="1" id="controle2" <?php if(@$validade == null){ echo'checked'; } ?>>
						  <label class="form-check-label" for="controle2">
						    Sem data de validade
						  </label>
						</div>

					</section>

					<section>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="f_dt" class="form-label">Data de vencimento</label>
								<input type="date" class="form-control" id="f_dt" name="f_dt" value="<?php echo @$validade ?>"/>
							</div> 
						</div>
					</section>

					<!-- Mensagem do Ajax -->
					<small><div align="center" class="mt-1" id="mensagem"></div></small>

				</div>

				<div class="modal-footer">

					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary" name="btn-salvar" id="btn-salvar">Salvar</button>

					<!-- CAMPOS ESCONDIDOS -->
					<input name="f_id" type="hidden" value="<?php echo @$_GET['id'] ?>">
					<input name="f_nome_a" type="hidden" value="<?php echo @$nome ?>">
					<input name="f_codigo_a" type="hidden" value="<?php echo @$codigo ?>">

				</div>
			</form>
		</div>
	</div>
</div>


<!-- MODAL - Descrição -->
<div class="modal fade" tabindex="-1" id="modalDados" >
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title"><span id="nome-registro"></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			
			<div class="modal-body mb-4">

				<b>Categoria: </b>
				<span id="categoria-registro"></span>
				<hr>
				
				<b>Descrição: </b>
				<span id="descricao-registro"></span>
				<hr>

				<img id="imagem-registro" src="" class="mt-4" width="200">
			</div> 

		</div>
	</div>
</div>


<?php
	require_once('_includes/ajax.php')
?>


<script type="text/javascript">
	function mostrarDados(nome, descricao, categoria){

		event.preventDefault();

		$('#nome-registro').text(nome);
		$('#categoria-registro').text(categoria);
		$('#descricao-registro').text(descricao);


		var myModal = new bootstrap.Modal(document.getElementById('modalDados'), {
			backdrop: 'static'
		})

		myModal.show();

		
	}
</script>


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
