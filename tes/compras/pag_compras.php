<?php
session_start();

if (!isset($_SESSION['nome_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "pedrinho13";
$dbname = "zero21";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Erro na conexão com o banco de dados.']);
    exit;
}

// Obter os dados da solicitação
$input = json_decode(file_get_contents('php://input'), true);
$cartItems = $input['cartItems'];

if (empty($cartItems)) {
    echo json_encode(['success' => false, 'message' => 'Carrinho está vazio.']);
    exit;
}

// Iniciar uma transação
$conn->begin_transaction();

try {
    foreach ($cartItems as $item) {
        $produto_id = intval($item['id']);
        $quantidade = intval($item['quantity']);

        // Atualizar a quantidade no estoque
        $update_sql = "UPDATE estoque SET quantidade = quantidade - ? WHERE produto_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ii", $quantidade, $produto_id);
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }
    }

    // Commit da transação
    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Rollback da transação em caso de erro
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Erro ao finalizar a compra: ' . $e->getMessage()]);
}

// Fechar a conexão
$conn->close();
?>
