<?php 

	/* VERIFICAR PERMISSÃO DO USUÁRIO */
	if(@$_SESSION['nivel_usu'] != 1 && @$_SESSION['nivel_usu'] != 2){

		echo "<script language='javascript'>window.location='../index.php'</script>";
		
	}

?>