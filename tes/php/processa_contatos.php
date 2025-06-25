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
$telefone_celular = $_POST['telefone_celular'];
$telefone_fixo = $_POST['telefone_fixo'];
$nome_usuario = $_POST['nome_usuario'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

// Salva o CPF na sessão para uso nas próximas etapas
$_SESSION['nome_usuario'] = $nome_usuario;
$_SESSION['senha'] = $senha;
$_SESSION['email'] = $email;

// Atualiza os dados na tabela
$sql = "UPDATE dados_pessoais SET telefone_celular=?, telefone_fixo=?, nome_usuario=?, email=?, senha=? WHERE cpf=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $telefone_celular, $telefone_fixo, $nome_usuario, $email, $senha, $_SESSION['cpf']);

if ($stmt->execute() === TRUE) {
    echo "Contatos atualizados com sucesso!";
    // Chama a função para registrar o log
    registrarLog($conn, "Atualização de contatos bem-sucedida para o usuário ".$_SESSION['cpf']);
    // Redireciona para a próxima página
    header("Location: ../Pagina Cadastro/endereço.html");
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
