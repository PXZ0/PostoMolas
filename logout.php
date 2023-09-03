<?php 
    /* Incia sessão */
    @session_start();

    /* Destruir sessão */
    @session_destroy();

    /* Redirecionamento */
    echo "<script language='javascript'>window.location='index.php'</script>";
?>