<?php
session_start();

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
$nome_completo = $_POST['nome_completo'];
$data_nascimento = $_POST['data_nascimento'];
$nome_materno = $_POST['nome_materno'];
$cpf = $_POST['cpf'];
$genero = $_POST['genero'];

// Salva o CPF na sessão para uso nas próximas etapas
$_SESSION['cpf'] = $cpf;

// Insere os dados na tabela
$sql = "INSERT INTO dados_pessoais (nome_completo, data_nascimento, nome_materno, cpf, genero)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nome_completo, $data_nascimento, $nome_materno, $cpf, $genero);

if ($stmt->execute() === TRUE) {
    echo "Cadastro realizado com sucesso!";
    // Chama a função para registrar o log
    registrarLog($conn, "Cadastro realizado para CPF: " . $cpf);
    // Redireciona para a próxima página
    header("Location: ../Pagina Cadastro/contatos.html");
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
