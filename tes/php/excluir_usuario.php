<?php
session_start();

// Verifica se o usuário está logado ou tem permissão para excluir usuários
if (!isset($_SESSION['nome_usuario']) || $_SESSION['nome_usuario'] !== 'JoaoPD') {
    die("Acesso não autorizado.");
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "pedrinho13";
$dbname = "zero21";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se foi passado o ID do usuário a ser excluído
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Query para excluir o usuário
    $sql = "DELETE FROM dados_pessoais WHERE id = $userId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Usuário excluído com sucesso.";
    } else {
        echo "Erro ao excluir usuário: " . $conn->error;
    }
}

$conn->close();
?>
