<?php
session_start();

if (!isset($_SESSION['cpf'])) {
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
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

// Atualiza os dados na tabela
$sql = "UPDATE dados_pessoais SET cep=?, rua=?, complemento=?, bairro=?, cidade=?, estado=? WHERE cpf=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $cep, $rua, $complemento, $bairro, $cidade, $estado, $_SESSION['cpf']);

if ($stmt->execute() === TRUE) {
    echo "Endereço atualizado com sucesso!";
    // Chama a função para registrar o log
    registrarLog($conn, "Atualização de endereço bem-sucedida para o usuário cujo CPF é ".$_SESSION['cpf']);
    // Redireciona para a página de login ou outra página desejada
    header("Location: ../Pagina login/Pag_login.html");
    exit(); // Certifique-se de sair após redirecionar
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Função para registrar log
function registrarLog($conn, $acao) {
    $sql = "INSERT INTO log (acao, data_hora) VALUES (?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $acao);
    $stmt->execute();
    $stmt->close();
}
?>
