<?php
// Inicia a sessão
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "desafioprogramacao";
$_SESSION['success'] = "";
$msg_erro = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configura o modo de erro PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se os campos obrigatórios foram preenchidos
        if (!isset($_POST['email'], $_POST['senha'], $_POST['login']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $msg_erro = 'Por favor, preencha todos os campos obrigatórios do formulário e informe um endereço de email válido!';
            header('Location: login.php?msg_erro=' . urlencode($msg_erro));
            exit;
        } else {
            // Busca as informações do usuário no banco de dados
            $stmt = $conn->prepare("SELECT * FROM cadastro WHERE email=:email AND login=:login");
            $stmt->execute(array(':email'=>$_POST['email'], ':login'=>$_POST['login']));
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Verifica se a senha fornecida corresponde ao hash de senha armazenado
            if (password_verify($_POST['senha'], $results[0]['senha'])) {
                // Senha correta, redireciona para a página de sucesso
                if (count($results) == 1) {
                    $_SESSION['id'] = $results[0]['id'];
                    $_SESSION['nome'] = $results[0]['nome'];
                    $_SESSION['email'] = $results[0]['email'];
                    $_SESSION['login'] = $results[0]['login'];
                    $_SESSION['empregador'] = $results[0]['empregador'];
                    $_SESSION['candidato'] = $results[0]['candidato'];
                    $_SESSION['data_hora'] = $results[0]['data_hora'];
                    $_SESSION['success'] = "You are now logged in";
                    header('location: index.php');
                    header('Location: index.php');
                    exit;
                }
            } else {
                // Senha incorreta, exibe mensagem de erro
                $msg_erro = 'E-mail, login ou senha incorretos!';
                header('Location: login.php?msg_erro=' . urlencode($msg_erro));
                exit;
            }
        }
    }
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conn = null;
?>
