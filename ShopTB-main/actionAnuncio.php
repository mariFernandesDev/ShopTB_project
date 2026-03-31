<!-- Inclui o header.php -->
<?php include "header.php" ?>

    <?php
    
        //Verifica o método de requisição do servidor
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Define o bloco de variáveis para armazenar as informações recebidas do formulário
            $fotoAnuncio = $tituloAnuncio = $categoriaAnuncio = $descricaoAnuncio = $valorAnuncio = $dataAnuncio = $horaAnuncio = "";

            //Variável booleana para controle de erros de preenchimento
            $erroPreenchimento = false;
             $dataAnuncio = date("Y/m/d");
             $horaAnuncio = date("H:i:s");

            //Validação do campo tituloAnuncio
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["tituloAnuncio"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $tituloAnuncio = filtrar_entrada($_POST["tituloAnuncio"]);

                //Utiliza a função preg_match() para verificar se há apenas letras no nome
                if(!preg_match('/^[\p{L} ]+$/u', $tituloAnuncio)){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>TITULO</strong>
                    deve conter APENAS LETRAS!</div>";
                    $erroPreenchimento = true;
                }
            }

            //Validação do campo categoriaAnuncio
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["categoriaAnuncio"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>CATEGORIA</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $categoriaAnuncio = filtrar_entrada($_POST["categoriaAnuncio"]);
            }

            //Validação do campo descricaoAnuncio
            //Utiliza a função empty() para verificar se o campo está vazio
            if(empty($_POST["descricaoAnuncio"])){
                echo "<div class='alert alert-warning text-center'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
                $erroPreenchimento = true;
            }
            else{
                //Filtra e Armazena o valor na variável
                $descricaoAnuncio = filtrar_entrada($_POST["descricaoAnuncio"]);
            }

        
            // Inicio da validação do foto$fotoAnuncio
            $diretorio = "assets/img/"; //Define para qual diretório as imagens serão movidas
            $fotoAnuncio = $diretorio . basename($_FILES['foto$fotoAnuncio']['name']);//Montar o nome a ser salvo no BD
            $tipoDaImagem = strtolower(pathinfo($fotoAnuncio, PATHINFO_EXTENSION));//Pega o tipo do arquivo em letras minúsculas
            $erroUpload = false; //Variável para controle de erro do upload da foto


            // echo "<div class='container-fluid'>";
            // echo "<h1>Diretório: $diretorio</h1>";
            // echo "<h1>fOTO USUARIO: $fotoAnuncio</h1>";
            // echo "<h1>TIPO DA IMAGEM : $tipoDaImagem</h1>";
            // echo "</div>";

            // Verifica se o tamanho do arquivo é diferente de ZERO
            if($_FILES["foto$fotoAnuncio"]["size"] != 0){
                // Verifica se o tamanho do arquivo é maior que 5megabytes(MB)
                if($_FILES["foto$fotoAnuncio"]["size"] > 5000000){
                    echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve ter tamanho máximo de 5MB!</div>";
                    $erroUpload = true;
                }

                 // verifica se a foto está nos formatos JPG, JPEG, PNG ou WEBP
                if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                    echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve estar nos formatos png, jpeg, jpg ou webp!</div>";
                    $erroUpload = true;
                }

                // Verifica se a imagem foi movida para o diretório (assets/img)
                if(!move_uploaded_file($_FILES["foto$fotoAnuncio"]["tmp_name"], $fotoAnuncio)){
                    echo "<div class='alert alert-warning text-center'>Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!</div>";
                    $erroUpload = true;
                }
            }
            else{
                echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> é obrigatória!</div>";
                $erroUpload = true;
            }

            
    // Se não houver erro de preenchiomento e não houver erro no upload de foto 
            if(!$erroPreenchimento && !$erroUpload){


            // Criar uma variável para armazenar a QUERY que realiza a inserção de dados do Usuário na tabela Usuários
           $inserirAnuncio = "INSERT INTO Anuncio (fotoAnuncio, tituloAnuncio categoriaAnuncio, descricaoAnuncio)
                             VALUES ('$fotoAnuncio', '$tituloAnuncio','$categoriaAnuncio', '$descricaoAnuncio') ";

            // inclui o arquivo de conexão com o BD
            include "conexaoBD.php";


            // Se conseguir executara query de inserção exibe alerta de sucesso e a tabela com os dados informados
   if(mysqli_query($conn, $inserirAnuncio)){

                    echo "<div class='container'>";
                        echo "<div class='alert alert-success text-center'><strong>USUÁRIO</strong> cadastrado com sucesso!</div>";
                        echo "
                            <div class='container mt-3'>

                                <div class='container mt-3 mb-3 text-center'>
                                <img src='$fotoAnuncio' style='width:150px' title='Foto de $tituloAnuncio' class='img-thumbnail'>
                                </div>
                                <table class='table'>
                                    <tr>
                                        <th>TITULO</th>
                                        <td>$tituloAnuncio</td>
                                    </tr>
                                    <tr>
                                        <th>CATEGORIA</th>
                                        <td>$categoriaAnuncio</td>
                                    </tr>
                                    <tr>
                                        <th>DESCRICAO</th>
                                        <td>$descricaoAnuncio</td>
                                    </tr>
                                     <tr>
                                        <th>VALOR</th>
                                        <td>$valorAnuncio</td>
                                    </tr>
                                     <tr>
                                        <th>DATA</th>
                                        <td>$dataAnuncio, ás $horaAnuncio</td>
                                    </tr>
    
                                </table>
                            </div>
                        ";
                 echo "</div>";
                }
                else{
                    echo "<div class='alert alert-danger text-center'>Erro ao tentar inserir dados do  <strong>ANUNCIO</strong> no banco de dados $database</div>";
                }
            }
    }
        else{
            //Usa a função "header()" para redirecionar o usuário para o formUsuario.php
            header("location:formAnuncio.php");
        }

        //Função para filtrar entrada de dados
        function filtrar_entrada($dado){
            $dado = trim($dado); //Remove espaços desnecessários
            $dado = stripslashes($dado); //Remove barras invertidas
            $dado = htmlspecialchars($dado); //Converte caracteres especiais em entidades HTML

            //Retorna o dado após filtrado
            return($dado);
        }
    
    ?>

<!-- Inclui o footer.php -->
<?php include "footer.php" ?>