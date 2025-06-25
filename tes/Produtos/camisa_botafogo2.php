<?php
session_start();

// Modificar o produto_id de acordo com a página atual
$produto_id = isset($_GET['produto_id']) ? intval($_GET['produto_id']) : 0;

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/produtos.css">
  <link rel="stylesheet" href="../globals.css">
  <script src="../script.js" defer></script>
  <title>Produtos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      margin-top: 20px;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
      /* Centraliza o título */
    }

    .table-container {
      overflow-x: auto;
      /* Adiciona rolagem horizontal se a tabela for muito larga */
      margin: 0 auto;
      /* Centraliza a tabela */
    }

    table {
      width: 100%;
      /* Ajusta a largura da tabela para 100% da largura da tela */
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

    form {
      text-align: center;
      /* Centraliza o formulário */
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 5px;
      width: 80%;
      max-width: 300px;
      /* Largura máxima do campo de texto */
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      padding: 5px 15px;
      background-color: #00afef;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0084ff;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      min-width: 160px;
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
                    <li><button><a href="../php/consulta_usuarios.php">Usuários</a></button></li>
                  <?php endif; ?>
                  <?php if (isset($_SESSION['nome_usuario']) && $_SESSION['nome_usuario'] === 'JoaoPD') : ?>
                    <li><button><a href="../php/log.php">Log</a></button></li>
                  <?php endif; ?>
                  <li><button><a href="../php/logout.php">Logout</a></button></li>
                </ul>
              </li>
          </ul>
        <?php else : ?>
          <li><button id="accountButton"><a href="../Pagina login/Pag_login.html">Conta</a></button></li>
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
    <div class="produto">
      <div class="produto-img">
        <div id="box">
          <img src="../images/Botafogo-2.png" alt="Produto imagem principal" id="product-image">
          <div id="lens"></div>
        </div>
        <div class="thumbnail-images">
          <img src="../images/Botafogo-2.png" alt="Thumbnail 1">
          <img src="../images/Botafogo-2.png" alt="Thumbnail 2">
          <!-- Mais thumbnails -->
        </div>
      </div>
      <div class="product-details">
        <h1>Camisa Botafogo II 23/24 Torcedor Reebok Masculina</h1>
        <div class="product-rating center">
          <span>⭐⭐⭐⭐☆</span>
          <span>(1.259 avaliações)</span>
        </div>
        <div class="product-price center">
          <span>R$ 349,90</span>
          <span class="discount center">R$ 599,90</span>
        </div>
        <button class="buy-now" onclick="buyNow()">Comprar Agora</button>
        <button class="add-to-cart" onclick="addToCart(<?php echo $produto_id; ?>)">Adicionar ao Carrinho</button>
        <div class="product-description">
          <p>Camisa Botafogo I 23/24 Torcedor Reebok Masculina <br>
            Tecnologia <br>
            KOMBAT PRO SYSTEM®: Técnica autêntica que atribui uma elegância italiana ao design do produto, sustentando-se nas especificidades dos atletas profissionais. <br>

        </div>
        <div class="product-specs">
          <table>
            <tr>
              <th>Especificação</th>
              <th>Detalhes</th>
            </tr>
            <tr>
              <td>Dimensões</td>
              <td>10 x 20 x 30 cm</td>
            </tr>
            <!-- Mais especificações -->
          </table>
        </div>
      </div>
    </div>
    <div class="related-products">
      <h2>Produtos Relacionados</h2>
      <div class="produtos-relacionados">
        <div class="produto-relacionado">
          <a href="camisa_flamengo1.php"><img src="../images/Flamengo-1.png" alt="" width="150px" /></a>
          <p class="product-name">Camisa Flamengo <br> I 23/24 Torcedor Adidas Masculina</p>
          <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
          <p class="product-price"><span>R$ </span>149,90</p>
        </div>
        <div class="produto-relacionado">
          <a href="camisa_vasco.php"><img src="../images/Vasco.png" alt="" width="150px" /></a>
          <p class="product-name">Camisa Vasco <br> I 23/24 Torcedor Kappa Masculina</p>
          <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
          <p class="product-price"><span>R$ </span>149,90</p>
        </div>
        <div class="produto-relacionado">
          <a href="camisa_fluminense2.php"><img src="../images/Fluminense-2.png" alt="" width="150px" /></a>
          <p class="product-name">Camisa Fluminense <br> II 23/24 Torcedor Umbro Masculina</p>
          <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
          <p class="product-price"><span>R$ </span>149,90</p>
        </div>
      </div>
    </div>
    <div class="product-reviews">
      <h2>Avalie o produto</h2>
      <?php if (isset($_SESSION['nome_usuario'])) : ?>
        <div class="avaliacao1">
          <form id="review-form" class="review-form">
            <input type="hidden" name="produto_id" value="<?php echo $produto_id = '4'; ?>">
            <textarea id="review-box" name="review" placeholder="Escreva sua avaliação aqui..."></textarea>
            <br>
            <label for="rating">Nota:</label>
            <div class="stars">
              <span class="star" data-value="1">&#9733;</span>
              <span class="star" data-value="2">&#9733;</span>
              <span class="star" data-value="3">&#9733;</span>
              <span class="star" data-value="4">&#9733;</span>
              <span class="star" data-value="5">&#9733;</span>
            </div>
            <input type="hidden" id="rating-value" name="stars" value="0">
            <button class="button" type="submit">Enviar</button>
          </form>
        </div>
      <?php else : ?>
        <center>
          <p>Você precisa estar <a href="../Pagina login/Pag_login.html">logado</a> para avaliar o produto.</p>
        </center>
      <?php endif; ?>

      <div id="reviews">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "pedrinho13";
        $dbname = "zero21";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Falha na conexão: " . $conn->connect_error);
        }

        // Modificar a consulta SQL para filtrar por produto_id
        $sql = "SELECT nome_usuario, avaliacao, estrelas, data FROM avaliacoes WHERE produto_id = ? ORDER BY data DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $produto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $avaliacoes = [];

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $avaliacoes[] = $row;
          }
        }

        $conn->close();
        ?>

        <div id="reviews">
          <?php foreach ($avaliacoes as $avaliacao) : ?>
            <div class="review">
              <p><strong><?php echo htmlspecialchars($avaliacao['nome_usuario']); ?>:</strong> <?php echo htmlspecialchars($avaliacao['avaliacao']); ?> - <?php echo $avaliacao['estrelas']; ?> estrelas</p>
              <p><em><?php echo $avaliacao['data']; ?></em></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
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
          a vestirem suas paixôes.
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
    const navbar = document.querySelector(".navbar");
    const menuButton = document.querySelector(".menu-button");

    menuButton.addEventListener("click", () => {
      navbar.classList.toggle("show-menu");
    });

    const reviewForm = document.getElementById('review-form');
    const stars = document.querySelectorAll(".stars .star");
    const ratingValue = document.getElementById("rating-value");

    stars.forEach(star => {
      star.addEventListener("click", () => {
        const value = star.getAttribute("data-value");
        ratingValue.value = value;

        stars.forEach(s => {
          if (s.getAttribute("data-value") <= value) {
            s.classList.add("selected");
          } else {
            s.classList.remove("selected");
          }
        });
      });
    });

    reviewForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(reviewForm);

      fetch('../php/post_review.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            const review = data.avaliacao;
            const reviewElement = document.createElement('div');
            reviewElement.classList.add('review');
            reviewElement.innerHTML = `
                    <p><strong>${review.nome_usuario}:</strong> ${review.avaliacao} - ${review.estrelas} estrelas</p>
                    <p><em>${review.data}</em></p>
                `;
            document.getElementById('reviews').prepend(reviewElement);
            reviewForm.reset();
            ratingValue.value = 0;
            stars.forEach(star => star.classList.remove('selected'));
          } else {
            alert(data.message);
          }
        })
        .catch(error => {
          console.error('Erro ao enviar avaliação:', error);
        });
    });

    function isUserLoggedIn() {
      return <?php echo isset($_SESSION['nome_usuario']) ? 'true' : 'false'; ?>;
    }

    function addToCart(productId) {
      if (!isUserLoggedIn()) {
        alert('Você precisa estar logado para adicionar produtos ao carrinho.');
        window.location.href = '../Pagina login/Pag_login.html';
        return;
      }

      const product = {
        id: productId,
        name: 'Camisa Botafogo II 23/24 Torcedor Rebok Masculina', // Ajuste conforme necessário
        price: 149.90,
        image: '../images/Botafogo-2.png'
      };

      let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
      cartItems.push(product);
      localStorage.setItem('cart', JSON.stringify(cartItems));

      alert('Produto adicionado ao carrinho!');
    }

    function buyNow() {
      if (!isUserLoggedIn()) {
        alert('Você precisa estar logado para comprar produtos.');
        window.location.href = '../Pagina login/Pag_login.html';
        return;
      }

      window.location.href = '../compras/pag_compras.php'; // Ajuste conforme necessário
    }
  </script>
</body>

</html>