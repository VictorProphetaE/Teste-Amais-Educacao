<?php
if (isset($_GET['msg_erro'])) {
    $msg_erro = $_GET['msg_erro'];
    echo '
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="errorModalLabel">Error!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>' . $msg_erro . '</p>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#errorModal").modal("show");
        });
    </script>
    ';
}
if (isset($_GET['msg_sucesso'])) {
    $msg_sucesso = $_GET['msg_sucesso'];
    echo '
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Success!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>' . $msg_sucesso . '</p>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#successModal").modal("show");
        });
    </script>
    ';
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo isset($title) ? $title : 'My Website'; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8zrLZp/" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="script.js"></script>
        <?php echo isset($head) ? $head : ''; ?>
    </head>
    <body>
        <div>
        <nav class="navbar navbar-expand-lg sticky-top" style="background-color: wheat;">
        <div class="container-fluid">
            <ul class="nav ms-auto">
                <?php 
                if (!isset($_SESSION)) {
                    session_start();
                }else{
                    
                }
                if(isset($_SESSION['id'])) {

                    define('dbhost', 'localhost');
                    define('dbuser', 'root');
                    define('dbpass', '');
                    define('dbname', 'desafioprogramacao');
                    $conn = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Busca o tipo de usuário na tabela de usuários
                    $user_id = $_SESSION['id'];
                    $stmt = $conn->prepare("SELECT candidato, empregador FROM cadastro WHERE id = :id");
                    $stmt->bindParam(":id", $user_id);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Verifica se o candidato já possui cadastro
                    $id_candidato1 = $_SESSION["id"];
                    $sql1 = "SELECT * FROM curriculo_candidato WHERE id_candidato = ?";
                    $stmt1 = $conn->prepare($sql1);
                    $stmt1->bindParam(1, $id_candidato1);
                    $stmt1->execute();
                    $candidato = $stmt1->fetch();

                    if ($user && is_array($user) && isset($user['candidato']) && isset($user['empregador'])) {
                        if ($user['candidato'] == 1 && $user['empregador'] == 0) {
                            // Menu para usuários do tipo candidato
                            ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home</a>
                            </li>
                            <?php
                            if ($candidato && isset($candidato['ativo']) && $candidato['ativo'] == 1) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link active" href="visualizacandi.php">Visualizar currículo</a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link active" href="cadastro_curriculo.php">Cadastrar currículo</a>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="logout.php">Log Out</a>
                            </li>
                            <?php
                        } elseif ($user['candidato'] == 0 && $user['empregador'] == 1) {
                            // Menu para usuários do tipo empregador
                            ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="paginaempregador.php">Página do Empregador</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="logout.php">Log Out</a>
                            </li>
                            <?php
                        } 
                    }
                } else {
                    // Menu para usuários não logados
                    ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="registro.php">Registro</a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                </div>
            </nav>
            <div class="body">
                <?php echo isset($body) ? $body : ''; ?>
            </div>
            <script>
                $(document).ready(function() {
                    <?php if (isset($_SESSION['id'])) { ?>
                        console.log("User id: <?php echo $_SESSION['id']; ?>");         
                    <?php } ?>
                    $("#errorModal").modal("show");
                    $("#successModal").modal("show");
                });
            </script>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
            <footer class="text-center mt-5 py-3" style="background-color: wheat;">
                        &copy;  Victor Propheta Erbano <?php echo date("Y"); ?>. All rights reserved 
            </footer>
        </div>
    </body>
</html>