<?php
date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i:s');
$title = 'Registro';
$body = '
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <h1 class="text-center">Página de registro</h1>
            <form action="processar_form.php" method="post" onSubmit="return validarFormulario();">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail">
                    </div>
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Seu login">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="candidato" value="candidato">
                        <label class="form-check-label" for="candidato">
                            Candidato
                        </label>
                        </div>
                    <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="empregador" value="empregador" checked>
                            <label class="form-check-label" for="empregador">
                            Empregador
                        </label>
                    </div>
                    <div class="form-group" >
                        <input type="hidden" name="data_hora" value="<?= $data_hora ?>">
                        <button type="submit" class="btn btn-primary  mt-3">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
';

include 'layout.php';

?>

<script>
    function validarFormulario() {
        var nome = document.getElementById("nome").value;
        var email = document.getElementById("email").value;
        var login = document.getElementById("login").value;

        if (nome == "" || email == "" || login == "") {
            alert("Por favor, preencha todos os campos obrigatórios do formulário!");
            return false;
        }
    }
</script>
