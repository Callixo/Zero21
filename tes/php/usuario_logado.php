<?php
session_start();

header('Content-Type: application/json');

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "pedrinho13";
$dbname = "zero21";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Conexão falhou: " . $conn->connect_error]));
}

// Captura os dados enviados pelo JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$questionNumber = $data['questionNumber'];
$answer = $data['answer'];

error_log("Pergunta recebida: $questionNumber, Resposta recebida: $answer");

// Verifica a resposta com base na pergunta
$query = "";
if ($questionNumber == 1) {
    $query = "SELECT * FROM dados_pessoais WHERE nome_materno = ?";
} else if ($questionNumber == 2) {
    $query = "SELECT * FROM dados_pessoais WHERE data_nascimento = ?";
} else if ($questionNumber == 3) {
    $query = "SELECT * FROM dados_pessoais WHERE cep = ?";
}

// Preparar e executar a consulta
$stmt = $conn->prepare($query);
if (!$stmt) {
    error_log("Erro na preparação da consulta: " . $conn->error);
    die(json_encode(["error" => "Erro na preparação da consulta"]));
}

$stmt->bind_param("s", $answer);
$stmt->execute();
$result = $stmt->get_result();

$response = array("correct" => false);
if ($result->num_rows > 0) {
    $response["correct"] = true;

    // Salva o nome do usuário na sessão
    $user = $result->fetch_assoc();
    $_SESSION['nome_usuario'] = $nome_usuario['nome_usuario']; // Ajuste o campo conforme necessário
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
