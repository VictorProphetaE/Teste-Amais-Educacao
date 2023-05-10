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
// Array associativo que mapeia valores de escolaridade para descrições correspondentes
$escolaridade_descricao = array(
    'fundamental' => 'Ensino Fundamental',
    'medio' => 'Ensino Médio',
    'tecnico' => 'Ensino Técnico',
    'superior' => 'Ensino Superior',
    'pos' => 'Pós-Graduação',
    'mestrado' => 'Mestrado',
    'doutorado' => 'Doutorado'
);
// Obter a escolaridade selecionada pelo usuário
$escolaridade_selecionada = $candidato['escolaridade'];

// Obter a descrição correspondente à escolaridade selecionada
$escolaridade_descricao_selecionada = isset($escolaridade_descricao[$escolaridade_selecionada]) ? $escolaridade_descricao[$escolaridade_selecionada] : '';

date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i:s');
$title = 'Visualização de Currículo';
$body = '
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Dados do Candidato</h3>
                </div>
                <div class="card-body">
                    <p><strong>Nome: </strong> ' . ucfirst($_SESSION['nome']) . '</p>
                    <p><strong>Email: </strong>' . $_SESSION['email'] . '</p>
                    <p><strong>Login: </strong>' . $_SESSION['login'] . '</p>
                    <p><strong>CPF: </strong>' . $candidato['cpf'] . '</p>
                    <p><strong>Data de Nascimento: </strong>' .  date('d/m/Y', strtotime($candidato['data_nascimento'])) . '</p>
                    <p><strong>Sexo: </strong>' .  ucfirst($candidato['sexo']). '</p>
                    <p><strong>Estado Civil: </strong>' .  ucfirst($candidato['estado_civil']). '</p>
                    <p><strong>Escolaridade: </strong>' .  ucfirst($escolaridade_descricao_selecionada). '</p>
                    <p><strong>Cursos / Especializações: </strong>' . $cursos . '</p>
                    <p><strong>Experiência Profissional: </strong>' . $experiencia . '</p>
                    <p><strong>Pretensão Salarial: </strong>' . $pretensao . '</p>
                    <a href="atualizacao_curriculo.php" class="btn btn-primary">Editar Currículo</a>
                </div>
            </div>
        </div>
    </div>
</div>
';

include 'layout.php';

?>