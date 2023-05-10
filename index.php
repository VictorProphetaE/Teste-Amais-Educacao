<?php
session_start();
require 'configuracao.php';
$title = 'Home Page';
$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';
$body = '
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <h1>Seja Bem Vindo </h1>
            ';
if (!empty($nome)) {
    $body .= '<h1>Olá ' . ucfirst($nome) . '</h1>';
}
$body .= '
        </div>
    </div>
</div>';

include 'layout.php';
?>
