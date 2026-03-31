<?php

    $hostBD = "localhost"; //define op local do servidor
    $userBD = "root"; //define o usuário do BD (padrão:root)
    $senhaBD = "root"; //define a senha do BD (Padrão: " " [Em branco])
    $database = "shoptb"; //define qual base será realizada a conexão

    // função em php para estabelecer a conexão com o BD
    $conn = mysqli_connect($hostBD, $userBD, $senhaBD, $database);

    // Verificar se há conexão com o BD
    if(!$conn){
        echo "<p>Erro ao tentar conexão com a base de dados <strong>$database</strong></p>";
    }
?>