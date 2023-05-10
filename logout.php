<?php
    // Inicia a sessão
    session_start();
    
    // Remove todas as informações da sessão
    $_SESSION = array();
    
    // Destroi a sessão
    session_destroy();
    
    // Redireciona para a página de login
    header("Location: index.php");
    exit;
?>