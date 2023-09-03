<?php

	/* Variaviel de Pagina */
	$pag = "orcamento_adm";

?>


<section class="container">

	<!-- TABELA - Orçamentos em aberto -->
	<table id="orcamento" class="table table-hover my-4" style=" text-align: center;">

		<thead>
			<tr>
				<th colspan="4">
					<h3>Orçamentos Cadastrados</h3>
				</th>

				<th colspan="2">
					<form method="POST" id="form-pesquisa" action="">
						<input type="text" name="pesquisa" id="pesquisa" placeholder="Pesquisar Placa">
						<input type="submit" class="btn" name="s_pesquisa" value="pesquisar">
					</form>
					<?php

						if(isset($_POST['s_pesquisa'])){

							$placa = $_POST['pesquisa'];
							$query = $pdo->query("SELECT * from orcamentos WHERE placa LIKE '%$placa%' and status = 'completo'");

						}else{

							$query = $pdo->query("SELECT * from orcamentos WHERE status = 'completo'");
							
						}

					?>
				</th>
			</tr>

			<tr>
				<th>Placa</th>
				<th>Responsavel</th>
				<th>Dt Entrada</th>
				<th>Hr Entrada</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
			
		<tbody>
			<?php

			while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
			?>
			<tr>
				<td><?php echo($res['placa']); ?></td>
				<td><?php echo($res['cliente']); ?></td>
				<td>

					<?php
						$dt_fin=implode("/",array_reverse(explode("-",$res['dt_entrada']))); 
					echo($dt_fin);

					?>
						
				</td>
				<td><?php echo($res['hr_entrada']); ?></td>
				<td>
					<a href="index.php?pagina=finalizar_s&id=<?php echo($res['id_orcamento']); ?>" style="color: #f00; text-decoration: none;">Retornar</a>
				</td>
				<td>
					<a href="index.php?pagina=orcamento_adm&funcao=pagar&id=<?php echo($res['id_orcamento']); ?>'" title="Pagar" style="text-decoration: none">
						pagar
					</a>
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>

	</table>
	
</section>


<div class="modal fade" tabindex="-1" id="modalPagar" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Adicionar Informações</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" action="editar.php">
				<div class="modal-body">
					<div class="row">
					
						<div class="col-6">
								
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor a ser Pago</label>
								<input type="text" class="form-control" name="pagamento" value="0,00" required="">
							</div> 
							
						</div>
						<div class="col-6">
								
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nome do Pagador</label>
								<input type="text" class="form-control" name="nome" value="Sem nome" required="">
							</div> 
							
						</div>
					</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-pagar" type="submit" class="btn btn-danger">Pagar</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				</div>
			</form>
		</div>
	</div>
</div>

<?php 
if(@$_GET['funcao'] == "pagar"){ 
	$_SESSION['id_pagar_conta'] = @$_GET['id'];

	
	?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalPagar'), {
			
		})

		myModal.show();
	</script>
<?php
	
 } 
?>

