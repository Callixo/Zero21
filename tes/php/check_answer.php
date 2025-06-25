<?php
session_start();

header('Content-Type: application/json');

// Verifica se o usuário está autenticado
if (!isset($_SESSION['nome_usuario'])) {
    die(json_encode(["error" => "Usuário não autenticado"]));
}

$nome_usuario = $_SESSION['nome_usuario']; // Obtém o nome de usuário autenticado

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

// Consulta para obter o ID do usuário autenticado
$sql_id = "SELECT id FROM dados_pessoais WHERE nome_usuario = ?";
$stmt_id = $conn->prepare($sql_id);
if (!$stmt_id) {
    error_log("Erro na preparação da consulta de ID: " . $conn->error);
    die(json_encode(["error" => "Erro na preparação da consulta de ID"]));
}

$stmt_id->bind_param("s", $nome_usuario);
$stmt_id->execute();
$result_id = $stmt_id->get_result();

if ($result_id->num_rows != 1) {
    // Se o ID do usuário não puder ser encontrado, retorna erro
    die(json_encode(["error" => "ID de usuário não encontrado"]));
}

$row_id = $result_id->fetch_assoc();
$user_id = $row_id['id'];

// Verifica a resposta com base na pergunta e no usuário autenticado
$query = "";
if ($questionNumber == 1) {
    $query = "SELECT * FROM dados_pessoais WHERE id = ? AND nome_materno = ?";
} else if ($questionNumber == 2) {
    $query = "SELECT * FROM dados_pessoais WHERE id = ? AND data_nascimento = ?";
} else if ($questionNumber == 3) {
    $query = "SELECT * FROM dados_pessoais WHERE id = ? AND cep = ?";
}

// Preparar e executar a consulta
$stmt = $conn->prepare($query);
if (!$stmt) {
    error_log("Erro na preparação da consulta: " . $conn->error);
    die(json_encode(["error" => "Erro na preparação da consulta"]));
}

$stmt->bind_param("is", $user_id, $answer); // "i" para o ID (inteiro), "s" para a resposta (string)
$stmt->execute();
$result = $stmt->get_result();

$response = array("correct" => false);
if ($result->num_rows > 0) {
    $response["correct"] = true;
}

echo json_encode($response);

$stmt->close();
$stmt_id->close();
$conn->close();
?>
