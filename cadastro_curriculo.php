<?php
// Conexão com o banco de dados
if (!isset($_SESSION)) {
    session_start();
}
require 'configuracao.php';

$title = 'Registro';
$body = '
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Página de registro</h1>
                        <form id="registro-form" action="formulario_curriculo.php" method="post" onSubmit="return validarFormulario();">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" value=' . $_SESSION['nome'] . '>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail" value=' . $_SESSION['email'] . '>
                                    </div>
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Exemplo de CPF 555.555.777-88">
                                </div>
                                <div class="form-group">
                                    <label for="nascimento">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="nascimento" name="nascimento">
                                </div>
                                <div class="form-group">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control" id="sexo" name="sexo">
                                        <option selected>Abra menu de seleção</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                        <option value="outro">Outro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="estado_civil">Estado Civil</label>
                                    <select class="form-control" id="estado_civil" name="estado_civil">
                                        <option selected>Abra menu de seleção</option>
                                        <option value="solteiro">Solteiro(a)</option>
                                        <option value="casado">Casado(a)</option>
                                        <option value="divorciado">Divorciado(a)</option>
                                        <option value="viuvo">Viúvo(a)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="escolaridade">Escolaridade</label>
                                    <select class="form-control" id="escolaridade" name="escolaridade">
                                        <option selected>Abra menu de seleção</option>
                                        <option value="fundamental">Ensino Fundamental</option>
                                        <option value="medio">Ensino Médio</option>
                                        <option value="tecnico">Ensino Técnico</option>
                                        <option value="superior">Ensino Superior</option>
                                        <option value="pos">Pós-Graduação</option>
                                        <option value="mestrado">Mestrado</option>
                                        <option value="doutorado">Doutorado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cursos">Cursos/Especializações</label>
                                    <textarea class="form-control" id="cursos" name="cursos" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="experiencia">Experiência Profissional</label>
                                    <textarea class="form-control" id="experiencia" name="experiencia" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pretensao">Pretensão Salarial</label>
                                    <input type="text" class="form-control" id="pretensao" name="pretensao" placeholder="Sua pretensão salarial">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="data_hora" value="<?= $data_hora ?>">
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
';

include 'layout.php';

?>

<script>
const form = document.querySelector('form');
form.addEventListener('submit', function(event) {
  const nomeInput = document.getElementById('nome');
  const emailInput = document.getElementById('email');
  const cpfInput = document.getElementById('cpf');

  const nome = nomeInput.value;
  const email = emailInput.value;
  const cpf = cpfInput.value;

  const cpfRegex = /^(\d{3}\.){2}\d{3}\-\d{2}$/;

  if (nome === '' || email === '' || cpf === '') {
    alert('Por favor, preencha todos os campos obrigatórios do formulário!');
    event.preventDefault();
  } else if (!cpfRegex.test(cpf)) {
    alert('CPF inválido. Por favor, digite um CPF válido.');
    event.preventDefault();
  }
});

</script>
