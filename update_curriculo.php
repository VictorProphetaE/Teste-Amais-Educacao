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
    // Verifica se os campos obrigatórios foram preenchidos
    if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["login"]) && !empty($_POST["cpf"])) {
        // Obtém os valores do formulário
        $id_candidato = $_SESSION["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $login = $_POST["login"];
        $senha = $_POST["senha"];
        $cpf = $_POST["cpf"];
        $data_nascimento = date('Y/m/d', strtotime(str_replace('/', '-', $_POST['nascimento'])));
        $sexo = $_POST["sexo"];
        $estado_civil = $_POST["estado_civil"];
        $escolaridade = $_POST["escolaridade"];
        $cursos_especializacoes = $_POST["cursos"];
        $experiencia_profissional = $_POST["experiencia"];
        $pretensao_salarial = $_POST["pretensao"];

        
        // Verifica se a nova senha foi fornecida e a hasheia
        if (!empty($_POST["senha"])) {
            $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        } else {
            $senha = null;
        }
        // Verifica se o login já existe
        $sql_login = "SELECT id FROM cadastro WHERE login = ?";
        $stmt_login = $connect->prepare($sql_login);
        $stmt_login->bindParam(1, $login);
        $stmt_login->execute();
        $login_existente = $stmt_login->fetch();

        if ($login_existente && $login_existente['id'] != $id_candidato) {
            $msg_erro = 'Login já existe, escolha outro.';
            header('Location: atualizacao_curriculo.php?msg_erro=' . urlencode($msg_erro));
            exit;
        }
        date_default_timezone_set('America/Sao_Paulo');
        $data_hora = date('Y-m-d H:i:s');
        // Prepara a instrução SQL para atualização
        $sql_curriculo = "UPDATE curriculo_candidato SET nome=?, email=?, cpf=?, data_nascimento=?, sexo=?, estado_civil=?, escolaridade=?, cursos_especializacoes=?, experiencia_profissional=?, pretensao_salarial=?, data_hora=? WHERE id_candidato=?";
        $sql_cadastro = "UPDATE cadastro SET nome=?, email=?, login=?, senha=? WHERE id=?";

        // Prepara a declaração e vincula os parâmetros
        $stmt_curriculo = $connect->prepare($sql_curriculo);
        $stmt_curriculo->bindParam(1, $nome);
        $stmt_curriculo->bindParam(2, $email);
        $stmt_curriculo->bindParam(3, $cpf);
        $stmt_curriculo->bindParam(4, $data_nascimento);
        $stmt_curriculo->bindParam(5, $sexo);
        $stmt_curriculo->bindParam(6, $estado_civil);
        $stmt_curriculo->bindParam(7, $escolaridade);
        $stmt_curriculo->bindParam(8, $cursos_especializacoes);
        $stmt_curriculo->bindParam(9, $experiencia_profissional);
        $stmt_curriculo->bindParam(10, $pretensao_salarial);
        $stmt_curriculo->bindParam(11, $data_hora);
        $stmt_curriculo->bindParam(12, $id_candidato);

        $stmt_cadastro = $connect->prepare($sql_cadastro);
        $stmt_cadastro->bindParam(1, $nome);
        $stmt_cadastro->bindParam(2, $email);
        $stmt_cadastro->bindParam(3, $login);
        if (!empty($_POST["senha"])) {
          $stmt_cadastro->bindParam(4, $senha);
        } else {
          $stmt_cadastro->bindParam(4, $_SESSION["senha"]);
        }
        $stmt_cadastro->bindParam(5, $id_candidato);
    
        // Executa as instruções SQL
        $resultado_curriculo = $stmt_curriculo->execute();
        $resultado_cadastro = $stmt_cadastro->execute();
    
        // Verifica se as instruções foram executadas com sucesso
        if ($resultado_curriculo && $resultado_cadastro) {
            $msg_sucesso = 'Dados atualizados com sucesso!';
            header('Location: visualizacandi.php?msg_sucesso=' . urlencode($msg_sucesso));
            exit;
        } else {
            $msg_erro = 'Erro ao atualizar os dados.';
            header('Location: atualizacao_curriculo.php?msg_erro=' . urlencode($msg_erro));
            exit;
        }
    } else {
        $msg_erro = 'Preencha todos os campos obrigatórios.';
        header('Location: atualizacao_curriculo.php?msg_erro=' . urlencode($msg_erro));
        exit;
    }
}

    // Obtém os dados do candidato a partir do ID da sessão
    $id_candidato = $_SESSION["id"];
    $sql_candidato = "SELECT cadastro.email, cadastro.login, curriculo_candidato.* FROM cadastro INNER JOIN curriculo_candidato ON cadastro.id = curriculo_candidato.id_candidato WHERE cadastro.id = ?";
    $stmt_candidato = $connect->prepare($sql_candidato);
    $stmt_candidato->bindParam(1, $id_candidato);
    $stmt_candidato->execute();
    $candidato = $stmt_candidato->fetch(PDO::FETCH_ASSOC);

    // Fecha a conexão com o banco de dados
    $connect = null;
?>    