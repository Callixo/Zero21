<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    header("Location: ../Pagina login/Pag_login.html");
    exit();
}

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a forma de pagamento foi selecionada
    if (isset($_POST['forma_pagamento']) && ($_POST['forma_pagamento'] == 'credito' || $_POST['forma_pagamento'] == 'pix')) {
        // Aqui você pode implementar a lógica para processar o pagamento
        // Por exemplo, você pode enviar os detalhes do pagamento para um serviço de pagamento externo, como uma API de pagamento, e aguardar a resposta

        // Simulação de processamento de pagamento bem-sucedido
        // Aqui você pode redirecionar o usuário para uma página de confirmação de compra
        header("Location: confirmacao_compra.php");
        exit();
    } else {
        // Se a forma de pagamento não foi selecionada, redireciona de volta para a página de finalização de compra
        header("Location: finalizar_compra.php");
        exit();
    }
} else {
    // Se não for uma requisição POST, redireciona de volta para a página de finalização de compra
    header("Location: finalizar_compra.php");
    exit();
}
?>
