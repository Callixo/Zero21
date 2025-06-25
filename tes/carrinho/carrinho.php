<?php
session_start();

// Modificar o produto_id de acordo com a página atual
$produto_id = isset($_GET['produto_id']) ? intval($_GET['produto_id']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible"="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="carrinho.css">
  <link rel="stylesheet" href="../globals.css">
  <!-- <script src="carrinho.js" defer></script> -->
  <title>Carrinho de Compras</title>
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
    <h1 class="center">Carrinho de Compras</h1>
    <div id="cart-items">
      <!-- Os itens do carrinho serão adicionados aqui via JavaScript -->
    </div>
    <div class="center">
      <p id="total-price">Total: R$ 0.00</p>
      <button class="buy-now" onclick="buyNow()">Finalizar Compras</button>
    </div>
  </div>

  <footer class="gray-background">
    <div class="page-inner-content footer-content">
      <div class="download-options">
        <p>Baixe nosso aplicativo</p>
        <p>Baixe nosso aplicativo para Android e iOS</p>
        <div>
          <img src="/images/app-store.png" alt="" />
          <img src="/images/play-store.png" alt="" />
        </div>
      </div>
      <div class="logo-footer">
        <h1 class="logo">ZERO<span>21</span></h1>
        <p>Nosso objetivo é ajudar as diversas torcidas do RJ
          a vestirem suas paixões.
        </p>
      </div>
      <div id="contato-loja" class="links-footer">
        <h3>Links úteis</h3>
        <ul>
          <li>Cupons</li>
          <li>Blog</li>
          <li>Políticas</li>
          <li>Tornar-se afiliado</li>
          <li>Contato: (xx)xxxxx-xxxx</li>
        </ul>
      </div>
    </div>
    <hr class="page-inner-content" />
    <div class="page-inner-content copyright">
      <p>Copyright 2023 - Cidadão Anônimo - Todos Direitos Reservados</p>
    </div>
  </footer>

  <script>
    // JavaScript para manipular itens do carrinho
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');


    function removeFromCart(id) {
      console.log('Removendo item com o ID:', id);
      let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
      const updatedCartItems = cartItems.filter(item => item.id !== id); // Filtrar todos os itens exceto o que corresponde ao ID fornecido
      localStorage.setItem('cart', JSON.stringify(updatedCartItems)); // Atualizar o armazenamento local com a lista filtrada
      loadCartItems(); // Atualizar a interface do usuário para refletir as alterações
    }
    // Mova a chamada para loadCartItems fora de uma função assíncrona
    document.addEventListener('DOMContentLoaded', () => {
      loadCartItems();
    });

    // Função para carregar itens do carrinho
    function loadCartItems() {
      const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
      const uniqueItems = {};

      // Agrupar itens por ID e somar quantidades
      cartItems.forEach(item => {
        if (uniqueItems[item.id]) {
          uniqueItems[item.id].quantity += 1;
        } else {
          uniqueItems[item.id] = {
            ...item,
            quantity: 1
          };
        }
      });

      // Remove a lógica de verificação de itens únicos
      cartItemsContainer.innerHTML = '';
      let total = 0;

      // Renderiza itens únicos
      Object.values(uniqueItems).forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.classList.add('produto');

        itemElement.innerHTML = `
      <div class="produto-img">
        <img src="${item.image || ''}" alt="${item.name || ''}">
      </div>
      <div class="product-details">
        <h2>${item.name || ''}</h2>
        <p class="product-price">R$ ${(item.price || 0).toFixed(2)}</p>
        <div class="quantity-controls">
          <button class="decrement-quantity" onclick="decrementQuantity('${item.id}')">-</button>
          <span class="quantity">${item.quantity || 0}</span>
          <button class="increment-quantity" onclick="incrementQuantity('${item.id}')">+</button>
        </div>
        <button class="remove-from-cart" onclick="removeFromCart('${item.id}')">Remover</button>
      </div>
    `;

        cartItemsContainer.appendChild(itemElement);
        total += (item.price || 0) * (item.quantity || 0);
      });

      totalPriceElement.textContent = `Total: R$ ${total.toFixed(2)}`;
    }


    function isUserLoggedIn() {
      return <?php echo isset($_SESSION['nome_usuario']) ? 'true' : 'false'; ?>;
    }

    function incrementQuantity(id) {
      let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
      const itemIndex = cartItems.findIndex(item => item.id === id);
      if (itemIndex !== -1) {
        cartItems[itemIndex].quantity++;
        localStorage.setItem('cart', JSON.stringify(cartItems));
        loadCartItems();
      }
    }

    function decrementQuantity(id) {
      let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
      const itemIndex = cartItems.findIndex(item => item.id === id);
      if (itemIndex !== -1 && cartItems[itemIndex].quantity > 1) {
        cartItems[itemIndex].quantity--;
        localStorage.setItem('cart', JSON.stringify(cartItems));
        loadCartItems();
      }
    }



    function buyNow() {
      if (!isUserLoggedIn()) {
        alert('Você precisa estar logado para comprar produtos.');
        window.location.href = '../Pagina login/Pag_login.html';
        return;
      }

      const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

      // Passa os itens do carrinho como parâmetros na URL
      const queryString = cartItems.map(item => `productId=${item.id}`).join('&');
      window.location.href = `../compras/finalizar_compra.php?${queryString}`;
    }
  </script>
</body>

</html>