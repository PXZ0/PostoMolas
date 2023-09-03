<?php 
	
	/* Variavel de Identificação da Página*/
	$pag = 'usuarios';

?>

<!-- Criação de novo usaurio -->
<section>
	<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" type="button" class="btn btn-secondary mt-2">Novo Usuário</a>
</section>

<section class="container">

	<?php

		/* APRESENTAÇÃO DE USUARIOS */
		$busca = $pdo-> query("SELECT * from usuarios order by id desc");

		$usus = $busca-> fetchAll(PDO::FETCH_ASSOC);

		$total = @count($usus);

		if($total > 0){ 

			?>
			<small>

				<!-- TABELA - Usuarios -->
				<table id="example" class="table table-hover my-4" style="width:100%; text-align: center;">

					<thead>
						<tr>
							<th colspan="6">
								<h3>Usuários</h3>
							</th>
						</tr>

						<tr>
							<th>Nome</th>
							<th>Usuario</th>
							<th>Email</th>
							<th>Senha</th>
							<th>Nível</th>
							<th>Ações</th>
						</tr>

					</thead>

					<tbody>

						<?php 

						for($i=0; $i < $total; $i++){
							foreach ($usus[$i] as $key => $value){ }
								?>

								<tr>
									<td><?php echo $usus[$i]['nome'] ?></td>
									<td><?php echo $usus[$i]['usuario'] ?></td>
									<td><?php echo $usus[$i]['email'] ?></td>
									<td><?php echo ('********'); ?></td>
									<td>
										<?php switch ($usus[$i]['nivel']) {
											case 1:
												echo('Administrador');
											break;
											
											case 2:
												echo('Operador');
											break;

											default:
												echo(' Nivel de usuario desconhecido! ');
											break;
										}
									?>
									 	
									</td>

									<td>
										<!-- BOTÕES - Editar e Excluir -->
										<a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $usus[$i]['id'] ?>" title="Editar Registro">
											<i class="bi bi-pencil-square text-primary"></i>
										</a>

										<a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $usus[$i]['id'] ?>" title="Excluir Registro">
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

			echo ('<p>Não existem dados para serem exibidos!</p>');

		} 
	?>

</section>


<?php 

	/* Confirmação de modal - Editar ou Cadastrar */
	if(@$_GET['funcao'] == "editar"){

		$titulo_modal = 'Editar Registro';

		$busca = $pdo-> query("SELECT * from usuarios where id = '$_GET[id]'");

		$usus = $busca-> fetch(PDO::FETCH_ASSOC);

		$total_reg = @count($usus);

		if($total_reg > 0){ 

			$nome = $usus['nome'];
			$email = $usus['email'];
			$usuario = $usus['usuario'];
			$senha = $usus['senha'];
			$nivel = $usus['nivel'];

		}

	}else{

		$titulo_modal = 'Cadastrar Usuário';

	}

?>


<!-- MODAL - Cadastrar e Editar -->
<div class="modal fade" tabindex="-1" id="modal_ce" data-bs-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">

				<h5 class="modal-title"><?php echo $titulo_modal ?></h5>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

			</div>

			<!-- FORMULÁRIO - Cadastro e Edição de Usuario -->
			<form method="POST" action="" id="form_ce" name="form_ce">

				<div class="modal-body">

					<div class="mb-3">
						<label for="f_nome" class="form-label">Nome</label>
						<input type="text" class="form-control" id="f_nome" name="f_nome" placeholder="Nome" required value="<?php echo @$nome ?>" />
					</div>
					
					<div class="mb-3">
						<label for="f_usuario" class="form-label">Usuario</label>
						<input type="text" class="form-control" id="f_usuario" name="f_usuario" placeholder="Usuario" required value="<?php echo @$usuario ?>" />
					</div> 

					<div class="mb-3">
						<label for="f_email" class="form-label">Email</label>
						<input type="email" class="form-control" id="f_email" name="f_email" placeholder="Email" required="" value="<?php echo @$email ?>" />
					</div>  

					<div class="mb-3">
						<label for="f_senha" class="form-label">Senha</label>
						<input type="password" class="form-control" id="f_senha" name="f_senha" placeholder="Senha" />
					</div>  

					<div class="mb-3">

						<label for="f_nivel" class="form-label">Nível</label>
						<select class="form-select mt-1" aria-label="Default select example" id="f_nivel" name="f_nivel">
							
							<option <?php if(@$nivel == '2'){ ?> selected <?php } ?>  value="2">Operador</option>

							<option <?php if(@$nivel == '1'){ ?> selected <?php } ?>  value="1">Administrador</option>

						</select>

					</div> 

					<small>
						<div align="center" class="mt-1" id="mensagem"></div> 						
					</small>

				</div>

				<div class="modal-footer">

					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn_salvar" id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>

					<!-- Campos Escondidos -->
					<input name="f_id" type="hidden" value="<?php echo @$_GET['id'] ?>">
					<input name="f_email_a" type="hidden" value="<?php echo @$email ?>">
					<input name="f_usuario_a" type="hidden" value="<?php echo @$usuario ?>">

				</div>
				
			</form>
		</div>
	</div>
</div>

<?php
	require_once('_includes/ajax.php');
?>