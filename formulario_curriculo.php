<?php
// Conexão com o banco de dados
if (!isset($_SESSION)) {
    session_start();
}
require 'configuracao.php';

$msg_erro = "";
$msg_sucesso = "";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtém os valores do formulário
    $id_candidato = $_SESSION["id"];
    $nome = $_SESSION["nome"];
    $email = $_SESSION["email"];
    $cpf = $_POST["cpf"];

    // Formata a data de nascimento
    $data_nascimento = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['nascimento'])));
    $sexo = $_POST["sexo"];
    $estado_civil = $_POST["estado_civil"];
    $escolaridade = $_POST["escolaridade"];
    $cursos_especializacoes = $_POST["cursos"];
    $experiencia_profissional = $_POST["experiencia"];
    $pretensao_salarial = $_POST["pretensao"];
    date_default_timezone_set('America/Sao_Paulo');
    $data_hora = date('Y-m-d H:i:s');
    // Prepara a instrução SQL para inserção
    $sql = "INSERT INTO curriculo_candidato (id_candidato, nome, email, cpf, data_nascimento, sexo, estado_civil, escolaridade, cursos_especializacoes, experiencia_profissional, pretensao_salarial, ativo, data_hora) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração e vincula os parâmetros
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $id_candidato);
    $stmt->bindParam(2, $nome);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $cpf);
    $stmt->bindParam(5, $data_nascimento);
    $stmt->bindParam(6, $sexo);
    $stmt->bindParam(7, $estado_civil);
    $stmt->bindParam(8, $escolaridade);
    $stmt->bindParam(9, $cursos_especializacoes);
    $stmt->bindParam(10, $experiencia_profissional);
    $stmt->bindParam(11, $pretensao_salarial);
    $stmt->bindValue(12, true, PDO::PARAM_BOOL);
    // Formata a data e hora de envio do currículo
    $stmt->bindParam(13, $data_hora);
    
    // Executa a instrução SQL

        if ($stmt->execute()) {
            // Redireciona para a página de sucesso
            $msg_sucesso = 'Usuário cadastrado com sucesso!';
            header('Location: index.php?msg_sucesso=' . urlencode($msg_sucesso));
            exit();
        } else {
            $msg_erro = "Erro ao enviar currículo. Por favor, tente novamente.";
            header('Location: cadastro_curriculo.php?msg_sucesso=' . urlencode($msg_sucesso));

        }
    }
?>        