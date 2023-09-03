<?php

	/* Variaviel de Pagina */
	$pag = "orcamento";

?>

<script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('endereco').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
</script>

<!-- Criar novo orçamento -->
<button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#novo_registro">
	Novo Orçamento
</button>

<section class="container">

	<div class="modal fade" id="novo_registro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
	  		<form method="POST" id="form-peca">
	    		<div class="modal-content">
	      			<div class="modal-header">

	        			<h5 class="modal-title" id="staticBackdropLabel">Novo Registro</h5>
	        			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      			</div>

					<!-- formulário -->
		      		<div class="modal-body">

		      			<section class="row">

			      			<div class="col-md-12">
								<div class="mb-12">
							      	<label for="f_responsavel" class="form-label">Nome do Responsavel</label>
							        <input type="text" class="form-control" id="f_responsavel" name="f_responsavel" placeholder="Nome do Responsavel" required="">
							        <br>
							    </div>
							</div>

						    <div class="col-md-6">
								<div class="mb-6">
							        <label for="f_celular" class="form-label">Celular</label>
							        <input type="text" class="form-control" id="f_celular" onkeypress="$(this).mask('(00) 0 0000-0000')" name="f_celular" placeholder="Celular">
							    </div>
							</div>

						    <div class="col-md-6">
								<div class="mb-6">
							        <label for="f_telefone" class="form-label">Telefone</label>
							        <input type="text" class="form-control" id="f_telefone" onkeypress="$(this).mask('0000-0000')" name="f_telefone" placeholder="Telefone">
							        <br>
							    </div>
							</div>

							<div class="col-md-4">
								<div class="mb-4">
							        <label for="cep" class="form-label">CEP</label>
							        <input type="text" class="form-control" id="cep" name="cep" onblur="pesquisacep(this.value);" placeholder="CEP" onkeypress="$(this).mask('00000-000')" maxlength="8" required="">
							    </div>
							</div>

							<div class="col-md-8">
								<div class="mb-8">
							        <label for="cidade" class="form-label">Cidade</label>
							        <input type="text" class="form-control" id="cidade" value="" name="cidade" placeholder="Cidade" required="">
							    </div>
							</div>

							<div class="col-md-12">
								<div class="mb-12">
							        <label for="bairro" class="form-label">Bairro</label>
							        <input type="text" class="form-control" id="bairro" value="" name="bairro" placeholder="Bairro" required="">
							        <br>
							    </div>
							</div>

							<div class="col-md-8">
								<div class="mb-8">
							        <label for="endereco" class="form-label">Endereço</label>
							        <input type="text" class="form-control" id="endereco" value="" name="endereco" placeholder="Endereço" required="">
							    </div>
							</div>

							<div class="col-md-4">
								<div class="mb-4">
							        <label for="numero" class="form-label">Numero</label>
							        <input type="text" class="form-control" id="numero" value="" name="numero" placeholder="Numero" required="">
							    </div>
							</div>

							<div class="col-md-8">
								<div class="mb-8">
							      	<label for="f_veiculo" class="form-label">Nome do Veiculo</label>
							        <input type="text" class="form-control" id="f_veiculo" name="f_veiculo" placeholder="Nome do Veiculo" required="">
							    </div>
							</div>

							<div class="col-md-4">
								<div class="mb-4">
							        <label for="f_placa" class="form-label">Placa do Veiculo</label>
							        <input type="text" class="form-control" id="f_placa" name="f_placa" placeholder="Placa do Veiculo" required="" onkeypress="$(this).mask('AAA-0A00')">
							    </div>
							</div>

							<div class="col-md-8">
								<div class="mb-8">
							        <label for="f_modelo" class="form-label">Nome do Modelo</label>
							        <input type="text" class="form-control" id="f_modelo" name="f_modelo" placeholder="Nome do Modelo" required="">
							    </div>
							</div>

							<div class="col-md-4">
								<div class="mb-4">
							        <label for="f_km" class="form-label">Kilometragem atual</label>
							        <input type="text" class="form-control" id="f_km" name="f_km" placeholder="Digite a kilometragem" required="">
							    </div>
							</div>

							<div class="col-md-12">
								<div class="mb-12">
							        <label for="f_cor" class="form-label">Cor</label>
							        <input type="text" class="form-control" id="f_cor" name="f_cor" placeholder="Cor" required="">
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

		if(isset($_POST['salvar'])){

			/* VARIAVEIS - formulario */
			$placa = $_POST['f_placa'];
			$responsavel = $_POST['f_responsavel'];
			$celular = $_POST['f_celular'];
			$telefone = $_POST['f_telefone'];
			$cep = $_POST['cep'];
			$cidade = $_POST['cidade'];
			$bairro = $_POST['bairro'];
			$endereco = $_POST['endereco'];
			$numero = $_POST['numero'];
			$veiculo = $_POST['f_veiculo'];
			$modelo = $_POST['f_modelo'];
			$cor = $_POST['f_cor'];
			$km_atual =$_POST['f_km'];


			$controle = 'n';
			$query = $pdo->query("SELECT * FROM orcamentos WHERE placa = '$placa'");

			while (@$res = @$query->fetch(PDO::FETCH_ASSOC)) {
				if(@$res['status'] == "incompleto"){
					$controle = "s";
				}else{
					$controle = 'n';
				}
			}

			if($controle=="n"){

				$res = $pdo->prepare("INSERT INTO orcamentos SET dt_entrada = curDate(), hr_entrada = curTime(), cliente = :cliente, placa = :placa, status = 'incompleto', celular = :celular, telefone = :telefone, cep = :cep, cidade = :cidade, bairro = :bairro, endereco = :endereco, numero = :numero, veiculo = :veiculo, modelo = :modelo, cor = :cor, km_atual = :km_atual");

				$res->bindValue(":cliente", $responsavel);
				$res->bindValue(":celular", $celular);
				$res->bindValue(":telefone", $telefone);
				$res->bindValue(":cep", $cep);
				$res->bindValue(":cidade", $cidade);
				$res->bindValue(":bairro", $bairro);
				$res->bindValue(":endereco", $endereco);
				$res->bindValue(":numero", $numero);
				$res->bindValue(":veiculo", $veiculo);
				$res->bindValue(":modelo", $modelo);
				$res->bindValue(":cor", $cor);
				$res->bindValue(":km_atual", $km_atual);
				$res->bindValue(":placa", $placa);

				$res->execute();

			}else{

				echo("<script>window.alert('Veiculo já encontrado');</script>");

			}
				
		}

	?>


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
							$query = $pdo->query("SELECT * from orcamentos WHERE placa LIKE '%$placa%' and status = 'incompleto'");

						}else{

							$query = $pdo->query("SELECT * from orcamentos WHERE status = 'incompleto'");
							
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
				<td><a href="index.php?pagina=finalizar_s&id=<?php echo($res['id_orcamento']); ?>"  style="color: #f00; text-decoration: none;">Finalizar</a></td>
				<td><a href="index.php?pagina=n_orcamento&id=<?php echo($res['id_orcamento']); ?>"  style="color: #f00; text-decoration: none;">Adicionar Serviço</a></td>
			</tr>
			<?php
			}
			?>
		</tbody>

	</table>
	
</section>


<!---------------- modal de cadastro de orçamento --------->
<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title">Escreva</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        			<span aria-hidden="true">&times;</span>
        		</button>
			</div>

			<form method="POST" id="form">
				<div class="modal-body">

					<div class="row">

						<div class="col-md-6">
							<div class="mb-3">
								<label for="f_nome" class="form-label">Nome</label>
								<input type="text" class="form-control" id="f_nome" name="f_nome" placeholder="Nome" required>
							</div> 
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="f_cpf" class="form-label">CPF</label>
								<input type="text" class="form-control" id="f_cpf" name="f_cpf" placeholder="CPF" required onkeypress="$(this).mask('000.000.000-00')">
							</div>  
						</div>

					</div>					

					<div class="mb-3">
						<label for="f_telefone" class="form-label">Telefone</label>
						<input type="f_telefone" class="form-control" id="f_telefone" name="f_telefone" placeholder="(11) 9 1111-1111" required onkeypress="$(this).mask('(00) 0 0000-0000')">
					</div>  

				</div>

				<div class="modal-footer">
					<button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button name="btn_salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

					<input name="antigo" type="hidden" value="<?php echo @$cpf ?>">
					<input name="antigo2" type="hidden" value="<?php echo @$email ?>">

				</div>
			</form>
		</div>
	</div>
</div>

<!----------------------- fim ------------------------->


<!---------------------------------- processar os dados para pesquisa ------------------------------>

<div class="modal fade" tabindex="-1" id="modalEditar" >
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
									<label for="exampleFormControlInput1" class="form-label">CPF</label>
									<input type="text" class="form-control" name="cpf" placeholder="xxx.xxx.xxx-xx" onkeypress="$(this).mask('000.000.000-00')" required="" >
								</div> 
								
							</div>
						<div class="col-6">
								
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Nome</label>
									<input type="text" class="form-control" name="nome" required="">
								</div> 
								
							</div>
						</div>
					
						<div class="col-6">
								
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Desconto</label>
								<input type="text" class="form-control" name="desconto" value="0.00" required="">
							</div> 
							
						</div>
					</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-editar" type="submit" class="btn btn-danger">Salvar</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				</div>
			</form>
		</div>
	</div>
</div>

<?php 
if(@$_GET['funcao'] == "editar"){ 
	$_SESSION['id_edit'] = @$_GET['id'];
	?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalEditar'), {
			
		})

		myModal.show();
	</script>
<?php } 
?>

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

	$id = $_SESSION['id_pagar_conta'];
	$query = $pdo->query("SELECT * from contas_em_aberto where id_contas ='$id'");
	$linha = $query->fetch(PDO::FETCH_ASSOC);
	$_SESSION['valor'] = $linha['total_conta'];
	?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalPagar'), {
			
		})

		myModal.show();
	</script>
<?php
	
 } 
?>


<?php 
if(@$_GET['funcao'] == "visualizar"){ 
	$_SESSION['id_visualizar'] = @$_GET['id'];
	
} 
?>

<!-- VALORES CADASTRO -->
<?php
	if(isset($_POST['btn_salvar'])){

		/* Variaveis */
		$nome = $_POST['f_nome'];
		$cpf = $_POST['f_cpf'];
		$telefone = $_POST['f_telefone'];

		/* Verificação se ja existe */

		$busca = $pdo->prepare('SELECT * FROM contas WHERE cpf = :cpf');

		$busca->bindValue(':cpf', $cpf);

		$busca->execute();

		$conta = $busca->fetch(PDO::FETCH_ASSOC);

		if($conta == 0){

			$ins = $pdo->prepare('INSERT INTO contas SET nome = :nome, cpf = :cpf, telefone = :telefone;');

			$ins->bindValue(':nome', $nome);
			$ins->bindValue(':cpf', $cpf);
			$ins->bindValue(':telefone', $telefone);

			$ins->execute();

			if($ins->rowCount()){

				echo('<script>window.alert("Cliente cadastrado com sucesso");</script>');

			}else{

				echo('<script>window.alert("acorda animal que ta errado");</script>');

			}
			
		}else{

			echo('<script>window.alert("Cliente ja existe");</script>');
			
		}
	}
?>