<?php

	/* Verificação de Variavel */
	if(isset($_GET['produ'])){
		
		$categoria = $_GET['categoria'];

		?>
				
		<style type="text/css">
			.botao{
				margin: 30px;
				border-radius: 20px;
			}
			.botao:hover{
				background-color: #00f;
			}

			.link{
				text-decoration: none;
			}
			.link:hover{
				color: #fff;
			}
		</style>
	

		<section class="container">

			<?php

				$busca = $pdo->query("SELECT * from categorias WHERE id = '$categoria' ");

				$cate = $busca->fetch(PDO::FETCH_ASSOC);
			?>


			<!-- TABELA - Produtos da Categoria -->
			<table id="produtos" class="table table-hover my-4" style=" text-align: center;">

				<thead>

					<tr>
						<th colspan="4">
							<h3>Produtos (<?php echo $cate['nome']?>)</h3>
						</th>
					</tr>

					<tr>
						<th>Código</th>
						<th>Nome</th>						
						<th>Estoque</th>
						<th>Valor</th>
					</tr>

				</thead>	

				<tbody>

					<?php

						$busca = $pdo->query("SELECT * from produtos WHERE categoria = '$categoria' ");

						while ($prod = $busca->fetch(PDO::FETCH_ASSOC)) {

							?>
							<tr>
								<td>
									<?php
										echo $prod['id'];
									?>
								</td>
								<td>
									<?php
										echo $prod['nome'];
									?>
								</td>								
								<td>
									<?php
										echo $prod['estoque'];
									?>
								</td>
								
								<td>
									<?php
										echo $prod['valor'];
									?>
								</td>
							</tr>

							<?php
						}
					?>

				</tbody>

			</table>

		</section>

		<?php
	}
?>