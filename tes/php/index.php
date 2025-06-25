<?php
session_start();

// Verifica se o formulário de login foi enviado
if(isset($_POST['nome_usuario'], $_POST['senha'])) {
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "pedrinho13";
    $dbname = "zero21";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $nome_usuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];

    // Consulta o banco de dados para verificar as credenciais
    $sql = "SELECT * FROM dados_pessoais WHERE nome_usuario='$nome_usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if(password_verify($senha, $row['senha'])) {
            // Credenciais válidas, define as variáveis de sessão
            $_SESSION['nome_usuario'] = $nome_usuario;
            $_SESSION['senha'] = $senha;
            // Retorna "success" para indicar que o login foi bem-sucedido
            echo "success";
        } else {
            // Senha incorreta, retorna "error"
            echo "error";
        }
    } else {
        // Usuário não encontrado, retorna "error"
        echo "error";
    }

    $conn->close();
} else {
    // Formulário de login não enviado, exibe mensagem de acesso não autorizado
    die("Acesso não autorizado.");
}
?>
