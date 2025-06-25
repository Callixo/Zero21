<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zero21 | Ecommerce</title>
  <link rel="stylesheet" href="globals.css">
  <!-- <script>
    // Passa a informação do usuário logado para o JavaScript
    const nome_usuario = <?php echo json_encode(isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : null); ?>;
  </script> -->
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
        <a href="carrinho/carrinho.php"><img src="images/cart.png" /></a>
        <img src="images/menu.png" class="menu-button" />
      </div>
    </div>
  </div>

  <header>
    <div id="home-loja" class="header-inner-content">
      <div class="header-bottom-side">
        <div class="header-bottom-side-left">
          <h2>Dê um novo estilo à sua paixão!</h2>
          <p>
            Sucesso nem sempre tem haver com grandeza.
            Tem haver com consitência. <br> Trabalho duro
            consistente supera o sucesso. A grandeza virá.
          </p>
          <button>Ver Agora &#8594;</button>
        </div>
        <div class="header-bottom-side-right">
          <img src="images/Flamengo.png" alt="" />
        </div>
      </div>
    </div>
  </header>

  <!-- Conteúdo principal -->
  <main>
    <div class="gray-background">
      <div class="page-inner-content">
        <div class="cols cols-3">
          <img src="images/Flamengo-1.png" alt="" />
          <img src="images/Fluminense-2.png" alt="" />
          <img src="images/Vasco-1.png" alt="" />
        </div>
      </div>
    </div>
    <div id="produtos-loja">
      <div class="page-inner-content">
        <h3 class="section-title">Produtos Selecionados</h3>
        <div class="subtitle-underline"></div>
        <div class="cols cols-4">
          <div class="product">
            <a href="Produtos/camisa_bangu.php"><img src="images/Bangu.jpeg" alt="Camisa de Bangu" /></a>
            <p class="product-name">Camisa Bangu I 23/24 Torcedor Kappa Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>149,90</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_campogrande.php"><img src="images/Campo Grande.jpeg" alt="" /></a>
            <p class="product-name">Camisa Campo Grande I 23/24 Torcedor WA Sport Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>149,90</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_madureira.php"><img src="images/Madureira.jpeg" alt="" /></a>
            <p class="product-name">Camisa Madureira I 23/24 Torcedor Icone Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>149,90</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_novaiguaçu.php"><img src="images/Nova Iguaçu.jpeg" alt="" /></a>
            <p class="product-name">Camisa Nova Iguaçu I 23/24 Torcedor Icone Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>149,90</p>
          </div>
        </div>
      </div>
      <div class="page-inner-content">
        <h3 class="section-title">Ultimos Produtos</h3>
        <div class="subtitle-underline"></div>
        <div class="cols cols-4">
          <div class="product">
            <a href="Produtos/camisa_botafogo1.php"><img class="camisa-png" src="images/Botafogo-1.png" alt="" /></a>
            <p class="product-name">Camisa Botafogo I 23/24 Torcedor Reebok Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>349,90</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_flamengo1.php"><img src="images/Flamengo-1.png" alt="" /></a>
            <p class="product-name">Camisa Flamengo I 23/24 Torcedor Adidas Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>349,90</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_fluminense1.php"><img class="camisa-png" src="images/Fluminense.png" alt="" /></a>
            <p class="product-name">Camisa Fluminense I 23/24 Torcedor Umbro Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>349,90</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_vasco.php"><img src="images/Vasco-1.png" alt="" /></a>
            <p class="product-name">Camisa Vasco I 23/24 Torcedor Kappa Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>349,90</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_botafogo2.php"><img class="camisa-png" src="images/Botafogo-2.png" alt="" /></a>
            <p class="product-name">Camisa Botafogo II 23/24 Torcedor Reebok Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>349,90</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_flamengo2.php"><img src="images/Flamengo-2.png" alt="" /></a>
            <p class="product-name">Camisa Flamengo II 23/24 Torcedor Adidas Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>349,50</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_fluminense2.php"><img src="images/Fluminense-2.png" alt="" /></a>
            <p class="product-name">Camisa Fluminense II 23/24 Torcedor Umbro Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>349,50</p>
          </div>
          <div class="product">
            <a href="Produtos/camisa_vasco1.php"><img src="images/Vasco.png" alt="" /></a>
            <p class="product-name">Camisa Vasco II 23/24 Torcedor Kappa Masculina</p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p class="product-price"><span>R$ </span>349,50</p>
          </div>
        </div>
      </div>


    </div>

    <div id="sobre-loja" class="gray-background">
      <div class="header-inner-content">
        <div class="header-bottom-side exclusive-container">
          <div id="sobre_loja" class="header-bottom-side-left">
            <h2>Sobre a Zero21</h2>
            <p> Na Zer021, respiramos o esporte carioca. Somos sua loja urbana de artigos esportivos, onde o amor pelo
              Flamengo, Vasco, Fluminense, Botafogo, Volta Redonda, etc... se encontra. Com uma seleção única de
              produtos, estamos aqui para vestir você com o orgulho dos times do Rio de Janeiro. Seja para as
              arquibancadas ou para as ruas da cidade, estamos prontos para elevar sua paixão pelo esporte. Vem com a
              gente e celebre a energia do Rio na Zer021!
            </p>
            <button>Ver Agora &#8594;</button>
          </div>
          <div class="header-bottom-side-right">
            <img src="images/zer021-branco.png" alt="" />
          </div>
        </div>
      </div>
    </div>

    <div>
      <div class="page-inner-content">
        <div class="avaliadores">
          <div class="avaliador">
            <p>'</p>
            <p>Loja incrível, desde o processo de compra, até a chegada do produto, A forma que trata os clientes é até
              acolhedora. Nota 10.
            </p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p>Marcos Alonso</p>
          </div>
          <div class="avaliador">
            <p>'</p>
            <p>Minha experiência de compra foi excelente. O site era fácil de navegar e tinha uma interface intuitiva.
              Encontrei facilmente os produtos que estava procurando e o processo de compra foi simples e seguro.
            </p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p>Maria Santos</p>
          </div>
          <div class="avaliador">
            <p>'</p>
            <p>Fiquei muito impressionado com o site. Ele foi projetado de forma tão intuitiva que me senti como se
              estivesse navegando por uma loja física. Encontrar os produtos que eu queria foi fácil e rápido.
            </p>
            <p class="rate">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p>Pedro Oliveira</p>
          </div>
        </div>
      </div>
    </div>



  </main>

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
    document.addEventListener("DOMContentLoaded", () => {
      const accountButton = document.getElementById("accountButton");
      const dropdownContent = document.getElementById("dropdownContent");

      if (nome_usuario) {
        accountButton.innerHTML = `<a href="#">${nome_usuario}</a>`;
        if (dropdownContent) {
          accountButton.parentElement.classList.add("dropdown");
          dropdownContent.style.display = "block";
        }
      } else {
        if (dropdownContent) {
          dropdownContent.style.display = "none";
        }
      }
    });

    const navbar = document.querySelector(".navbar");
    const menuButton = document.querySelector(".menu-button");

    menuButton.addEventListener("click", () => {
      navbar.classList.toggle("show-menu");
    });
  </script>
</body>

</html>