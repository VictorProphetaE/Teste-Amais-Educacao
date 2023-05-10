<?php
require 'configuracao.php';
// Conexão com o banco de dados
if (!isset($_SESSION)) {
    session_start();
}

$id_candidato = $_SESSION["id"];
$sql_candidato = "SELECT cadastro.email, cadastro.login, curriculo_candidato.* FROM cadastro INNER JOIN curriculo_candidato ON cadastro.id = curriculo_candidato.id_candidato WHERE cadastro.id = ?";
$stmt_candidato = $connect->prepare($sql_candidato);
$stmt_candidato->bindParam(1, $id_candidato);
$stmt_candidato->execute();
$candidato = $stmt_candidato->fetch(PDO::FETCH_ASSOC);
$row = $stmt_candidato->fetch(PDO::FETCH_ASSOC);
$cursos = $candidato['cursos_especializacoes'];
$experiencia = $candidato['experiencia_profissional'];
$pretensao = $candidato['pretensao_salarial'];
$data_hora = date('Y-m-d H:i:s');
$title = 'Ataulização curriculo';
$body = '
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1>Página de Atualizar currículo</h1>
                        <form id="myForm" action="update_curriculo.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required value=' . $_SESSION['nome'] . ' autocomplete="off">
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" required value=' . $_SESSION['email'] . ' autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" id="login" name="login" required value=' . $_SESSION['login'] . ' autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="senha">Nova senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" autocomplete="off" required>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" required value=' . $candidato['cpf'] . ' autocomplete="off">
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                <label for="nascimento" class="form-label">Data de nascimento *</label>
                                <input type="date" class="form-control" id="nascimento" name="nascimento" required value=' .  $candidato['data_nascimento']. '>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                <label for="sexo" class="form-label">Sexo *</label>
                                <select class="form-control" id="sexo" name="sexo" required>
                                    <option value="" selected disabled>Selecione...</option>
                                    <option value="masculino" ' . ($candidato['sexo'] == 'masculino' ? 'selected' : '') . '>Masculino</option>
                                    <option value="feminino" ' . ($candidato['sexo'] == 'feminino' ? 'selected' : '') . '>Feminino</option>
                                    <option value="outro" ' .  ($candidato['sexo'] == 'outro' ? 'selected' : '') . '>Outro</option>
                                </select>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                            <label for="estado_civil" class="form-label">Estado civil *</label>
                            <select class="form-control" id="estado_civil" name="estado_civil" required>
                                <option value="" selected disabled>Selecione...</option>
                                <option value="solteiro" ' . ($candidato['estado_civil'] == 'solteiro' ? 'selected' : '') . '>Solteiro(a)</option>
                                <option value="casado" ' . ($candidato['estado_civil'] == 'casado' ? 'selected' : '') . '>Casado(a)</option>
                                <option value="divorciado" ' . ($candidato['estado_civil'] == 'divorciado' ? 'selected' : '') . '>Divorciado(a)</option>
                                <option value="viuvo" ' . ($candidato['estado_civil'] == 'viuvo' ? 'selected' : '') . '>Viúvo(a)</option>
                            </select>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="escolaridade">Escolaridade</label>
                            <select class="form-control" id="escolaridade" name="escolaridade">
                                <option value="" selected disabled>Selecione...</option>
                                <option value="fundamental" ' . ($candidato['escolaridade'] == 'fundamental' ? 'selected' : '') . '>Ensino Fundamental</option>
                                <option value="medio" ' . ($candidato['escolaridade'] == 'medio' ? 'selected' : '') . '>Ensino Médio</option>
                                <option value="tecnicoo" ' . ($candidato['escolaridade'] == 'tecnico' ? 'selected' : '') . '>Ensino Técnico</option>
                                <option value="superior" ' . ($candidato['escolaridade'] == 'superior' ? 'selected' : '') . '>Ensino Superior</option>
                                <option value="pos" ' . ($candidato['escolaridade'] == 'pos' ? 'selected' : '') . '>Pós-Graduação</option>
                                <option value="mestrado" ' . ($candidato['escolaridade'] == 'mestrado' ? 'selected' : '') . '>Mestrado</option>
                                <option value="doutorado" ' . ($candidato['escolaridade'] == 'doutorado' ? 'selected' : '') . '>Doutorado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cursos">Cursos/Especializações</label>
                            <textarea class="form-control" id="cursos" name="cursos" rows="3">' . $cursos . '</textarea>
                        </div>
                        <div class="form-group">
                            <label for="experiencia">Experiência Profissional</label>
                            <textarea class="form-control" id="experiencia" name="experiencia" rows="3">' . $experiencia . '</textarea>
                        </div>
                        <div class="form-group">
                            <label for="pretensao">Pretensão Salarial</label>
                            <input type="text" class="form-control" id="pretensao" name="pretensao" required value=' . $pretensao . ' >
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="data_hora" value=' . $data_hora. ' >
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
  const cpfInput = document.getElementById('login');
  const cpfInput = document.getElementById('cpf');

  const nome = nomeInput.value;
  const email = emailInput.value;
  const login = emailInput.value;
  const cpf = cpfInput.value;

  const cpfRegex = /^(\d{3}\.){2}\d{3}\-\d{2}$/;

  if (nome === '' || email === '' || login === ''|| cpf === '') {
    alert('Por favor, preencha todos os campos obrigatórios do formulário!');
    event.preventDefault();
  } else if (!cpfRegex.test(cpf)) {
    alert('CPF inválido. Por favor, digite um CPF válido.');
    event.preventDefault();
  }
});

</script>