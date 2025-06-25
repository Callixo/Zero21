<?php
session_start();

if (!isset($_SESSION['email'])) {
    die("Acesso não autorizado.");
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "pedrinho13";
$dbname = "zero21";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Captura dos dados do formulário
$nova_senha = $_POST['nova_senha'];

// Atualiza os dados na tabela
$sql = "UPDATE dados_pessoais SET senha = ? WHERE email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", password_hash($nova_senha, PASSWORD_DEFAULT), $_SESSION['email']);

if ($stmt->execute() === TRUE) {
    echo "Senha atualizada com sucesso!";
    // Redireciona para a página de login ou outra página desejada
    header("Location: ../Pagina login/Pag_login.html");
    exit(); // Certifique-se de sair após redirecionar
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
