<?php
session_start();

// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba os dados do formulário
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    // Conecte-se ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "pedrinho13";
    $dbname = "zero21";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifique se o e-mail e a data de nascimento correspondem aos registros no banco de dados
    $sql = "SELECT * FROM dados_pessoais WHERE email = ? AND data_nascimento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $data_nascimento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Se encontrou um registro correspondente, defina a variável de sessão para o e-mail
        $_SESSION['email'] = $email;
        // Redirecione para a página de redefinir senha
        header("Location: redefinir_senha.html");
        exit();
    } else {
        // Se não encontrou correspondência, exiba uma mensagem de erro
        echo "E-mail ou data de nascimento incorretos.";
    }

    $stmt->close();
    $conn->close();
}
?>
