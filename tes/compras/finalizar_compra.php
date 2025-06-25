<?php
session_start();

// Simulação de cálculo de total baseado nos IDs dos produtos passados por GET
$cartTotal = 0; // Inicialize o total

// Verifica se há produtos na query string e calcula o total
if (!empty($_GET['productId'])) {
  $productIds = explode(',', $_GET['productId']);
  // Aqui você poderia buscar os preços dos produtos no banco de dados, mas para fins de exemplo, vamos simular:
  $precoProduto = 50.00; // Preço simulado de um produto

  foreach ($productIds as $productId) {
    // Simulando a soma dos preços dos produtos
    $cartTotal += $precoProduto;
  }
}

// Exemplo de valores fixos para teste
$cartTotal = 500.00; // Valor total do carrinho

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../globals.css">
  <title>Finalizar Compra</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      margin-top: 20px;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    .log-container {
      display: flex;
      justify-content: center;
    }

    table {
      width: 800px;
      border-collapse: collapse;
      margin-top: 20px;
      text-align: left;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      min-width: 170px;
      background-color: #2c2c2c;
      padding: 0.7rem;
      top: 30px;
      box-shadow: 10px 0px 10px #2c2c2c;
      z-index: 99;
    }

    #accountButton:hover .dropdown-content {
      display: block;
    }


    .excluir {
      background-color: #00afef;
      padding: 5px 10px;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }

    .excluir:hover {
      background-color: #0084ff;
    }

    @media screen and (max-width: 600px) {
      input[type="text"] {
        width: 100%;
        /* Ajusta a largura do campo de texto para ocupar toda a largura da tela */
        max-width: none;
        /* Remove a largura máxima definida */
      }
    }
  </style>
</head>

<body>
  <div class="navbar">
    <div class="header-inner-content">
      <h1 class="logo">ZERO<span>21</span></h1>
      <nav>
        <ul>
          <li><button><a href="../index.php#home-loja">Home</a></button></li>
          <li><button><a href="../index.php#produtos-loja">Produtos</a></button></li>
          <li><button><a href="../index.php#sobre_loja">Sobre</a></button></li>
          <li><button><a href="../index.php#contato-loja">Contato</a></button></li>
          <ul class="conectado">
            <?php if (isset($_SESSION['nome_usuario'])) : ?>
              <li id="accountButton"><button><a href="#"><?php echo $_SESSION['nome_usuario']; ?></a></button>
                <ul class="dropdown-content">
                  <?php if (isset($_SESSION['nome_usuario']) && $_SESSION['nome_usuario'] === 'JoaoPD') : ?>
                    <li><button><a href="php/consulta_usuarios.php">Usuários</a></button></li>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['nome_usuario']) && $_SESSION['nome_usuario'] === 'JoaoPD') : ?>
                    <li><button><a href="php/log.php">Log</a></button></li>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['nome_usuario']) && $_SESSION['nome_usuario'] === 'JoaoPD') : ?>
                    <li><button><a href="php/modelo_bd.php">Modelo BD</a></button></li>
                  <?php endif; ?>
                  <li><button><a href="php/logout.php">Logout</a></button></li>
                </ul>
              </li>
          </ul>
        <?php else : ?>
          <li><button id="accountButton"><a href="Pagina login/Pag_login.html">Conta</a></button></li>
        <?php endif; ?>
        </ul>
      </nav>
      <div class="nav-icon-container">
        <a href="../carrinho/carrinho.php"><img src="../images/cart.png" /></a>
        <img src="../images/menu.png" class="menu-button" />
      </div>
    </div>
  </div>

  <div class="container">
    <h2>Total da Compra</h2>
    <p>Total a ser pago: R$ <?php echo number_format($cartTotal, 2, ',', '.'); ?></p>

    <form action="processar_pagamento.php" method="post">
      <label><input type="radio" name="forma_pagamento" value="debito" required> Cartão de Débito</label>
      <label><input type="radio" name="forma_pagamento" value="credito" required> Cartão de Crédito</label>
      <label><input type="radio" name="forma_pagamento" value="pix" required> PIX</label>

      <button type="submit" class="submit-btn">Confirmar Pagamento</button>
    </form>
  </div>
</body>

</html>