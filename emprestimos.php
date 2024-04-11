<?php

    try {
        $conectar = new PDO("sqlite:banco/banco_biblioteca.db"); 

        $sql = $conectar->query("SELECT * FROM tb_emprestimo");
        $tb_emprestimo = $sql->fetchAll(PDO::FETCH_ASSOC);
		
    } catch (\Throwable $th) {
        echo "nao ok";
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Biblioteca</title>
    <link rel="stylesheet" href="/css/estilo.css">
</head>
<body>
<header> 
        <img src="/img/Biblioteca-Banner.png" alt="Banner-de-Livros" title="Banner de Livros">   
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="usuarios.php">Usuários</a></li>
                <li><a href="livros.php">Livros</a></li>
                <li><a href="#">Emprestimos</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="cadastro-usuario">
            <h2>Cadastro de usuário</h2>
            <form action="usuarios_cadastro.php" method="POST">
                <label for="codigo_catalogacao">Código Catalogação (Livro):</label>
                <input type="text" name="codigo_catalogacao" id="codigo_catalogacao">

                <label for="matricula">Matricula (Usuário):</label>
                <input type="text" name="matricula" id="matricula">

                <label for="data_emprestimo">Data Empréstimo:</label>
                <input type="text" name="data_emprestimo" id="data_emprestimo">

                <label for="data_devolucao">Data Devolução:</label>
                <input type="text" name="data_devolucao" id="data_devolucao">

                <div class="botoes">
                    <input type="submit" value="Cadastrar">
                    <input type="reset" value="Limpar">
                </div>

            </form>
        </div>

        <div class="consulta-usuario">
            <h2>Consulta de Empréstimos</h2>
            <table>
                <tr>
                    <th>Código Catalogação</th>
                    <th>Matricula</th>
                    <th>Data Empréstimo</th>
                    <th>Data Devolução</th>
                    <th>Opções</th>
                </tr>
                <?php
                for($i = 0; $i < count($tb_emprestimo); $i++){
                    echo "<tr>";
                    echo "<td id='td_centro'>" . $tb_emprestimo[$i]['codigo_catalogacao'] . "</td>";
                    echo "<td id='td_centro'>" . $tb_emprestimo[$i]['matricula'] . "</td>";
                    echo "<td>" . $tb_emprestimo[$i]['data_emprestimo'] . "</td>";
                    echo "<td>" . $tb_emprestimo[$i]['data_devolucao'] . "</td>";
                    echo "<td id='td_centro'>";
                        echo "<a href='usuarios_visualizar.php?matricula=". $tb_emprestimo[$i]['matricula'] ."'>Visualizar</a>";
                        echo "<a href='usuarios_excluir.php?matricula=". $tb_emprestimo[$i]['matricula'] ."'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </main>
</body>
</html>

<?php
    $conectar = null;
?>