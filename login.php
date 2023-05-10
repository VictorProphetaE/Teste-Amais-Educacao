<?php
$title = 'Login';
$body = '
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <h1 class="text-center">Página de login</h1>';
            if (!empty($msg_erro)) {
                $body .= '<div class="alert alert-danger">' . $msg_erro . '</div>';
            }
            $body .= '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" class="form-control" placeholder="Seu e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="login">Login:</label>
                            <input type="text" name="login" class="form-control" placeholder="Seu login" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" class="form-control" placeholder="Sua senha" required>
                        </div>
                        <div class="text-center ">
                            <button type="submit" class="btn btn-primary mt-3">Entrar</button>
                        </div>
                    </form>
        </div>
    </div>
</div>';

include 'autenticacao.php';
include 'layout.php';

?>