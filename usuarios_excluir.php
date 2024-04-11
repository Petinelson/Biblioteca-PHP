<?php
/*
    try {
        $conectar = new PDO("sqlite:banco/banco_biblioteca.db"); 

        $matricula = $_GET['matricula'];
        
        $sql = $conectar->prepare("DELETE FROM tb_usuario WHERE matricula = :matricula");
        $sql->bindParam(':matricula', $matricula);
        $sql->execute();

        $conectar = null;
        header('Location: usuarios.php');
    } catch (\Throwable $th) {
        echo "falha";
    }

*/


// Capturando a matrícula via GET
$matricula = isset($_GET['matricula']) ? intval($_GET['matricula']) : null;

if (!$matricula) {
    echo "Matrícula inválida.";
    exit;
}

try {
    // Conexão com o banco de dados
    $conectar = new PDO("sqlite:banco/banco_biblioteca.db"); 

    // Preparando a query para deletar baseado na matrícula
    $sql = $conectar->prepare("DELETE FROM tb_usuario WHERE matricula = :matricula");
    $sql->bindParam(':matricula', $matricula, PDO::PARAM_INT);

    // Executando a query
    if ($sql->execute()) {
        echo "ok"; // Se excluído com sucesso
    } else {
        echo "Erro ao excluir o usuário."; // Se ocorrer algum erro na exclusão
    }
} catch (\Throwable $th) {
    echo "Erro ao conectar ou executar query no banco de dados."; // Para qualquer outro erro
}

// Encerrando a conexão
$conectar = null;

?>