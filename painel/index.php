<?php 

  /* SESSÃO */
  @session_start();

  /* REQUIRES */
  require_once('../conexao.php');
  require_once('permissao.php');


  /* Verificação de nivel de Usuario (1 - Adm, 2 - Operario)*/
  if($_SESSION['nivel_usu'] == 1){

    /* VARIAVEIS DO MENU ADMINISTRATIVO */
    $menu2 = 'usuarios';
    $menu3 = 'pagamentos';
    $menu4 = 'produtos';
    $menu5 = 'categorias';
    $menu6 = 'orcamento_adm';
    $menu7 = 'n_orcamento';
    $menu8 = 'prod_categoria';
    $menu9 = 'finalizar_s';
    $menu10 = 'clientes';

  }else if($_SESSION['nivel_usu'] == 2){
  

    /* VARIAVEIS DO MENU OPERARIO */
    $menu2 = 'produtos';
    $menu3 = 'categorias';
    $menu4 = 'orcamento';
    $menu5 = 'n_orcamento';
    $menu6 = 'finalizar_s';

  }


  /* RECUPERAR DADOS DO USUÁRIO */
  $busca = $pdo->query("SELECT * from usuarios WHERE id = '$_SESSION[id_usu]';;");

  $usu = $busca->fetch(PDO::FETCH_ASSOC);

  /* Variaveis - Usuario */
  $nome_usu = $usu['nome'];
  $email_usu = $usu['email'];
  $usuario_usu = $usu['usuario'];
  $senha_usu = $usu['senha'];
  $nivel_usu = $usu['nivel'];
  $id_usu = $usu['id'];

?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <!-- METAS -->
  	<meta charset="utf-8">
    <meta name="author" content="Thiago e Pedro">
    <meta name="description" content="Menu - Arutruck Molas">
    <meta name="keywords" content="Arutruck Molas">

    <!-- LINKS -->
    <link rel="stylesheet" type="text/css" href="../_css/_bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../_css/_datatables/datatables.min.css"/>
  	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- SCRIPTS -->
    <script type="text/javascript" src="../_js/_datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../_js/_jquery/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../_js/_bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="../_js/mascaras.js"></script>
  	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <title>Arutruck Molas - Painel de <?php if($_SESSION['nivel_usu'] == 1){ echo('Administrador'); } else { echo('Operador'); } ?></title>

  </head>

  <body>

  	<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #FD0002">

      <div class="container-fluid">

        <!-- Nome da Marca -->
        <a class="navbar-brand text-light" href="index.php" style="margin-left: 30px;">Arutruck Molas</a> 

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="color: #FFFFFF;">

            <?php

              /* MENU - Administrativo */
              if($_SESSION['nivel_usu'] == 1){

                ?>

                <li class="nav-item">
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu2 ?>">Usuários</a>
                </li>

                <li>
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu3 ?>">Pagamentos</a>
                </li>

                <li>
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu4 ?>">Produtos</a>
                </li>

                <li>
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu5 ?>">Categorias</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu6 ?>">Orçamentos</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu10 ?>">Clientes</a>
                </li>

                <?php

                /* MENU - Operario */
              }else if($_SESSION['nivel_usu'] == 2){

                ?>

                <li class="nav-item">
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu2 ?>">Produtos</a>
                </li>


                <li class="nav-item">
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu3 ?>">Categorias</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-light" href="index.php?pagina=<?php echo $menu4 ?>">Orçamentos</a>
                </li>
                
                <?php

              }

            ?>

          </ul>

          <div class="d-flex mx-3">

            <img src="../_img/_icons/icone-user.png" width="40px" height="40px">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">

                  <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $nome_usu ?>
                  </a>

                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                      <?php 

                        if($_SESSION['nivel_usu']==1){

                          ?>
                          <li>
                            <a class="dropdown-item" href="index?pagina=usuarios&funcao=editar&id=<?php echo($_SESSION['id_usu']); ?>">Editar Perfil</a>
                          </li>

                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <?php
                        }
                      ?>

                    <li>
                      <a class="dropdown-item" href="../logout.php">Sair</a>
                    </li>
                    
                  </ul>

                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <main class="container-fluid mt-2">

      <?php

      /* REQUIRES - Menu de Administrador */
      if($_SESSION['nivel_usu'] == 1){

        if(@$_GET['pagina'] == $menu2){
        	require_once($menu2. '.php');
        }

        else if(@$_GET['pagina'] == $menu3){
        	require_once($menu3. '.php');
        }

        else if(@$_GET['pagina'] == $menu4){
        	require_once($menu4. '.php');
        }

        else if(@$_GET['pagina'] == $menu5){
          require_once($menu5. '.php');
        }

        else if(@$_GET['pagina'] == $menu6){
          require_once($menu6. '.php');
        }

        else if(@$_GET['pagina'] == $menu7){
          require_once($menu7. '.php');
        }

        else if(@$_GET['pagina'] == $menu8){
          require_once($menu8. '.php');
        }
        else if(@$_GET['pagina'] == $menu9){
          require_once($menu9. '.php');
        }

        else if(@$_GET['pagina'] == $menu10){
          require_once($menu10. '.php');
        }
        
        else{
        	require_once('home.php');
        }


      /* REQUIRES - Menu de Operador */
      }else if($_SESSION['nivel_usu'] == 2){

        if(@$_GET['pagina'] == $menu2){
          require_once($menu2. '.php');
        }

        else if(@$_GET['pagina'] == $menu3){
          require_once($menu3. '.php');
        }

        else if(@$_GET['pagina'] == $menu4){
          require_once($menu4. '.php');
        }

        else if(@$_GET['pagina'] == $menu5){
          require_once($menu5. '.php');
        }

        else if(@$_GET['pagina'] == $menu6){
          require_once($menu6. '.php');
        }

        else{
          require_once('home.php');
        }

      }

      ?>
    </main>

  </body>

</html>