<?php
include "header.php";

?>
    <section class="py-5">
    <div class="d-flex justify-content mb-3">
        <div class="row">
            <div class="col">
        <?php
        echo "<h3 class='text-center'>Listar registros em uma tabela:</h3>";
        // query para listar todos os registros da tabela
        $listarUsuarios = "SELECT * FROM Usuarios";

        include "conexaoBD.php";
        // A função mysqli_query() é responsável pela execução de comandos SQL no BD
        $res = mysqli_query($conn, $listarUsuarios) or die("Erro ao tentar listar Usuários!");
        $totalUsuarios = mysqli_num_rows($res);//Usa a função para buscar a quantidade de registros encontreados pela query

        echo "<div class='alert alert-warning text-center'>
            Há <strong>$totalUsuarios</strong> cadastrados no sistema!
        </div>";

        // Parte 1 - Exibindo o cabealho da tabela para exibir os registros
        echo "<table class='table'>
        <thead class='table-dark'>
            <tr>
                <th>ID</th>
                <th>FOTO</th>
                <th>NOME</th>
                <th>DATA DE NASCIMENTO</th>
                <th>CIDADE</th>
                <th>EMAIL</th>
            </tr>
        </thead>
        <tbody>";

        // Parte 2 - Enquanto houver registros, executa a função abaixo para armazenar em variáveis php
        while($registro = mysqli_fetch_assoc($res)){
            $idUsuario = $registro['idUsuario'];
            $fotoUsuario = $registro['fotoUsuario'];
            $nomeUsuario = $registro['nomeUsuario'];
            $dataNascimentoUsuario = $registro['dataNascimentoUsuario'];
            $dia = substr($dataNascimentoUsuario, 8 , 2);
            $mes = substr($dataNascimentoUsuario, 5 , 2);
            $ano = substr($dataNascimentoUsuario, 0 , 4);
            $cidadeUsuario = $registro['cidadeUsuario'];
            $emailUsuario = $registro['emailUsuario'];


            // Exibir os valores armazenados
            echo"
            <tr>
                <td>$idUsuario</td>
                <td><img src='$fotoUsuario' title='Foto de $nomeUsuario' style='width:100px'></td>
                <td>$nomeUsuario</td>
                <td>$dia/$mes/$ano</td>
                <td>$cidadeUsuario</td>
                <td>$emailUsuario</td>
            </tr>
            ";
        }
        // Parte 4 Encerrar a tabela
        echo "</tbody>";
        echo "</table>";
        mysqli_close($conn);
        
        ?>
    </div>
   </div>
</div>

    </section>

<?php
include "footer.php";

?>