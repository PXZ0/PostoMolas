<!-- MODAL - Deletar -->
<div class="modal fade" tabindex="-1" id="modal_deletar" >
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title">Excluir Registro</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form method="POST" id="form_ex">
				<div class="modal-body">

					<p>Deseja Realmente Excluir o Registro?</p>

					<small>
						<div align="center" class="mt-1" id="mensagem-excluir"></div> 
					</small>

				</div>

				<div class="modal-footer">

					<button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-excluir" id="btn-excluir" type="submit" class="btn btn-danger">Excluir</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				</div>
			</form>

		</div>
	</div>
</div>

<!-- FUNÇÕES -->
<?php 

	if(@$_GET['funcao'] == "novo"){ 

		?>

		<script type="text/javascript">
			var myModal = new bootstrap.Modal(document.getElementById('modal_ce'), {
				backdrop: 'static'
			})

			myModal.show();
		</script>

		<?php
	} 

	if(@$_GET['funcao'] == "editar"){ 
		
		?>

		<script type="text/javascript">
			var myModal = new bootstrap.Modal(document.getElementById('modal_ce'), {
				backdrop: 'static'
			})

			myModal.show();
		</script>

		<?php 
	}

	if(@$_GET['funcao'] == "deletar"){ 

		?>

		<script type="text/javascript">
			var myModal = new bootstrap.Modal(document.getElementById('modal_deletar'), {
				
			})

			myModal.show();
		</script>

		<?php 
	} 
?>


<script type="text/javascript">

	$("#form_ce").submit(function () {

		var pag = "<?=$pag?>";

		event.preventDefault();

		var formData = new FormData(this);

		$.ajax({

			url: pag + "/ins_edt.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem').removeClass();

				if(mensagem.trim() == "Salvo com Sucesso!") {

                    $('#btn-fechar').click();
                    window.location = "index.php?pagina="+pag;

                } else {

                	$('#mensagem').addClass('text-danger');
                }

                $('#mensagem').text(mensagem);

            },

            cache: false,
            contentType: false,
            processData: false,

            xhr: function () {  // Custom XMLHttpRequest

            	var myXhr = $.ajaxSettings.xhr();

                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                	myXhr.upload.addEventListener('progress', function () {
                		/* faz alguma coisa durante o progresso do upload */
                	}, false);
                }
                
                return myXhr;
            }
        });
	});


	/* AJAX - Excluir Dados */
	$("#form_ex").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/excluir.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem').removeClass()

				if (mensagem.trim() == "Excluído com Sucesso!") {

					$('#mensagem-excluir').addClass('text-success')

                    $('#btn-fechar').click();
                    window.location = "index.php?pagina="+pag;

                } else {

                	$('#mensagem-excluir').addClass('text-danger')
                }

                $('#mensagem-excluir').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            
        });
	});
</script>