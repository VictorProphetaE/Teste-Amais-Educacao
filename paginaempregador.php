<?php
//Conexão com o banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "desafioprogramacao";

$conn = mysqli_connect($host, $user, $pass, $dbname);

//Verifica se a conexão foi bem sucedida
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

//Seleciona os dados do banco
$sql = "SELECT * FROM curriculo_candidato INNER JOIN cadastro ON curriculo_candidato.id_candidato = cadastro.id";
$result = mysqli_query($conn, $sql);
$title = 'Página de Lista';

//Verifica se a consulta retornou algum resultado
if (mysqli_num_rows($result) > 0) {
    //Cabeçalho da tabela
    $body = "<div class='table-responsive'>
                <table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Pretensão Salarial</th>
                    </tr>
                </thead>
                <tbody>";

    //Calcula a média das pretensões salariais
    $soma = 0;
    $count = 0;
    $media = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $soma += $row["pretensao_salarial"];
        $count++;
    }
    $media = $soma / $count;

    //Percorre os dados da consulta
    mysqli_data_seek($result, 0); //move o ponteiro para o início dos dados
    while ($row = mysqli_fetch_assoc($result)) {
        //Define a cor padrão como azul

        //Verifica se o valor da pretensão salarial é maior ou menor que a média
        if ($row["pretensao_salarial"] < $media) {
            $cor = "text-success"; //menor que a média: verde
        } elseif($row["pretensao_salarial"] >= $media) {
            $cor = "text-primary"; //maior ou igual à média: azul
        } else{
            $cor = "";
        }

        //Exibe os dados na tabela
        $body .= "<tr>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["email"] . "</td>
                <td class='salary " . $cor . "'>" . $row["pretensao_salarial"] . "</td>
            </tr>";

    }

    //Exibe a soma e a média das pretensões salariais
    $body .= "<tr>
            <td colspan='2' align='right'><b>Total:</b></td>
            <td>" . number_format($soma, 2, ',', '.') . "</td>
        </tr>";
    $body .= "<tr>
            <td colspan='2' align='right'><b>Média:</b></td>
            <td>" . number_format($media, 2, ',', '.') . "</td>
        </tr>";

    //Fim da tabela
    $body .= "</tbody></table></div>";
    
} else {
    //Caso não tenha nenhum resultado na consulta
    $body = "<div class='alert alert-warning' role='alert'>Não foram encontrados registros.</div>";
}

//Fecha a conexão com o banco de dados
mysqli_close($conn);

include 'layout.php';
?>