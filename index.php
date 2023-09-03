<?php 
	/* SESSÃO */
	@session_start();

	/* REQUIRES */
	require_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

	<head>		
		<!-- METAS -->
		<meta charset="UTF-8">
		<meta name="author" content="Thiago e Pedro">
		<meta name="description" content="Pagina de Login - Arutruck Molas">
		<meta name="keywords" content="Arutruck Molas">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- LINKS -->
		<link rel="stylesheet" type="text/css" href="_css/_bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="_fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="_fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
		<link rel="stylesheet" type="text/css" href="_css/_animate/animate.css">
		<link rel="stylesheet" type="text/css" href="_css/_hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="_css/_animsition/animsition.min.css">
		<link rel="stylesheet" type="text/css" href="_css/_select2/select2.min.css">	
		<link rel="stylesheet" type="text/css" href="_css/daterangepicker/daterangepicker.css">
		<link rel="stylesheet" type="text/css" href="_css/util.css">
		<link rel="stylesheet" type="text/css" href="_css/main.css">

		<!-- SCRIPT -->
		<script type="text/javascript" src="_js/_jquery/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="_js/_animsition/animsition.min.js"></script>
		<script type="text/javascript" src="_js/_bootstrap/popper.js"></script>
		<script type="text/javascript" src="_js/_bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="_js/_select2/select2.min.js"></script>
		<script type="text/javascript" src="_js/_daterangepicker/moment.min.js"></script>
		<script type="text/javascript" src="_js/_daterangepicker/daterangepicker.js"></script>
		<script type="text/javascript" src="_js/_countdowntime/countdowntime.js"></script>
		<script type="text/javascript" src="_js/main.js"></script>

		<title>Arutruck Molas</title>
	</head>

	<body>
		
		<main class="limiter">

			<section class="container-login100" style="background-image: url('_img/_backgrounds/bg-01.jpg');">
				<section class="wrap-login100 p-t-30 p-b-50">

					<!-- FORMULARIO - Login -->
					<form name="form_login" method="POST" action="login.php" class="login100-form validate-form p-b-33 p-t-5">

						<section class = "wrap-input100 validate-input" data-validate = "usuario">

							<input class="input100" type="text" id="f_usuario" name="f_usuario" placeholder="Nome de usuario" required autofocus />

							<span class="focus-input100" data-placeholder="&#xe82a;"></span>

						</section>

						<section class="wrap-input100 validate-input" data-validate="senha">

							<input class="input100" type="password" id="f_senha" name="f_senha" placeholder="Senha" />

							<span class="focus-input100" data-placeholder="&#xe80f;"></span>

						</section>

						<section class="container-login100-form-btn m-t-32">
							<button type="submit" class="login100-form-btn">
								Entrar
							</button>
						</section>

					</form>

				</section>
			</section>
			
		</main>

		<div id="dropDownSelect1"></div>

	</body>
</html>