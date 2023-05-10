<?php
    // Inicia a sessão
    session_start();

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "desafioprogramacao";
    $msg_erro = "";
    $msg_sucesso = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Configura o modo de erro PDO para exceção
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Define quais campos são obrigatórios
        $required_fields = ['nome', 'email', 'login', 'senha', 'flexRadioDefault'];

        // Verifica se os campos obrigatórios foram preenchidos
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                $msg_erro = 'Por favor, preencha todos os campos obrigatórios do formulário!';
                header('Location: registro.php?msg_erro=' . urlencode($msg_erro));
                exit;
            }
        }

        if (isset($_POST['flexRadioDefault'])) {
            $tipo = $_POST['flexRadioDefault'];
            $empregador = ($tipo == 'empregador') ? true : false;
            $candidato = ($tipo == 'candidato') ? true : false;
        } else {
            $tipo = null;
            $empregador = false;
            $candidato = false;
        }

        // Verifica se o e-mail ou login já está em uso
        $stmt = $conn->prepare("SELECT COUNT(*) FROM cadastro WHERE email = :email OR login = :login");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':login', $_POST['login']);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            $msg_erro = 'O e-mail ou login já está em uso!';
            header('Location: registro.php?msg_erro=' . urlencode($msg_erro));
            exit;
        }

        // Verifica se o email já está cadastrado na tabela
        $stmt = $conn->prepare("SELECT COUNT(*) FROM cadastro WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // O email já está cadastrado, exibe uma mensagem de erro
            $msg_erro = 'Este email já está cadastrado';
            header('Location: registro.php?msg_erro=' . urlencode($msg_erro));
            exit;
        }

        if(empty($msg_erro)){
            // Se o email não existe na tabela, continua com o INSERT
            $stmt = $conn->prepare("INSERT INTO cadastro (nome, email, login, senha, empregador, candidato, data_hora) 
                                VALUES (:nome, :email, :login, :senha, :empregador, :candidato, NOW())");
            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':login', $_POST['login']);
            $stmt->bindParam(':senha', password_hash($_POST['senha'], PASSWORD_DEFAULT));
            $stmt->bindParam(':empregador', $empregador, PDO::PARAM_BOOL);
            $stmt->bindParam(':candidato', $candidato, PDO::PARAM_BOOL);
            $stmt->execute();
            $msg_sucesso = 'Cadastro realizado com sucesso!';
            header('Location: login.php?msg_sucesso=' . urlencode($msg_sucesso));
            exit;
        }
    
    } catch(PDOException $e) {
        $msg_erro = 'Erro ao realizar cadastro: ' . $e->getMessage();
        header('Location: registro.php?msg_erro=' . urlencode($msg_erro));
        exit;
}