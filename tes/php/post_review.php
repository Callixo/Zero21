<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $servername = "localhost";
  $username = "root";
  $password = "pedrinho13";
  $dbname = "zero21";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
  }

  $produto_id = $_POST['produto_id'];
  $nome_usuario = $_SESSION['nome_usuario'];
  $avaliacao = $_POST['review'];
  $estrelas = $_POST['stars'];
  $data = date('Y-m-d H:i:s');

  $sql = "INSERT INTO avaliacoes (produto_id, nome_usuario, avaliacao, estrelas, data) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('issss', $produto_id, $nome_usuario, $avaliacao, $estrelas, $data);

  if ($stmt->execute()) {
    echo json_encode([
      'status' => 'success',
      'avaliacao' => [
        'nome_usuario' => $nome_usuario,
        'avaliacao' => $avaliacao,
        'estrelas' => $estrelas,
        'data' => $data,
      ]
    ]);
  } else {
    echo json_encode([
      'status' => 'error',
      'message' => 'Erro ao salvar a avaliação. Tente novamente mais tarde.'
    ]);
  }

  $stmt->close();
  $conn->close();
}
?>
