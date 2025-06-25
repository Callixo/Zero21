<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Log</title>
    <link rel="stylesheet" href="../globals.css">
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
                                        <li><button><a href="consulta_usuarios.php">Usuários</a></button></li>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['nome_usuario']) && $_SESSION['nome_usuario'] === 'JoaoPD') : ?>
                                        <li><button><a href="log.php">Log</a></button></li>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['nome_usuario']) && $_SESSION['nome_usuario'] === 'JoaoPD') : ?>
                                        <li><button><a href="modelo_bd.php">Modelo BD</a></button></li>
                                    <?php endif; ?>
                                    <li><button><a href="logout.php">Logout</a></button></li>
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
    <h2>Modelo BD</h2>

    <center>
        <div id="box">
            <img src="modelo_bd.png" alt="Modelo ER" id="product-image">
            <div id="lens"></div>
        </div>
    </center><br><br>
    <center>
        <div id="box2">
            <img src="modelo_bd2.png" alt="Modelo ER" id="product-image2">
            <div id="lens2"></div>
        </div>
    </center>

    <style>
        #box, #box2 {
            position: relative;
            overflow: hidden;
            width: 50%;            
        }

        #product-image, #product-image2 {
            width: 100%;
            height: auto;
            border: 4px solid;
        }

        #lens, #lens2 {
            position: absolute;
            border: 1px solid #d4d4d4;
            width: 100px;
            /* Ajuste conforme necessário */
            height: 100px;
            /* Ajuste conforme necessário */
            background: rgba(255, 255, 255, 0.5);
            cursor: none;
            display: none;
        }
    </style>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const box = document.getElementById("box");
            const img = document.getElementById("product-image");
            const lens = document.getElementById("lens");

            function moveLens(e) {
                const rect = box.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const lensWidth = lens.offsetWidth / 2;
                const lensHeight = lens.offsetHeight / 2;

                let left = x - lensWidth;
                let top = y - lensHeight;

                if (left < 0) left = 0;
                if (top < 0) top = 0;
                if (left > box.offsetWidth - lens.offsetWidth) left = box.offsetWidth - lens.offsetWidth;
                if (top > box.offsetHeight - lens.offsetHeight) top = box.offsetHeight - lens.offsetHeight;

                lens.style.left = left + 'px';
                lens.style.top = top + 'px';

                const zoomFactor = 1.5;
                img.style.transformOrigin = `${(left + lensWidth) / box.offsetWidth * 100}% ${(top + lensHeight) / box.offsetHeight * 100}%`;
                img.style.transform = `scale(${zoomFactor})`;
            }

            box.addEventListener("mousemove", moveLens);

            box.addEventListener("mouseenter", () => {
                lens.style.display = "block";
                img.style.transform = "scale(2)"; // Ajuste o fator de zoom conforme necessário
            });

            box.addEventListener("mouseleave", () => {
                lens.style.display = "none";
                img.style.transform = "scale(1)";
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const box = document.getElementById("box2");
            const img = document.getElementById("product-image2");
            const lens = document.getElementById("lens2");

            function moveLens(e) {
                const rect = box.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const lensWidth = lens.offsetWidth / 2;
                const lensHeight = lens.offsetHeight / 2;

                let left = x - lensWidth;
                let top = y - lensHeight;

                if (left < 0) left = 0;
                if (top < 0) top = 0;
                if (left > box.offsetWidth - lens.offsetWidth) left = box.offsetWidth - lens.offsetWidth;
                if (top > box.offsetHeight - lens.offsetHeight) top = box.offsetHeight - lens.offsetHeight;

                lens.style.left = left + 'px';
                lens.style.top = top + 'px';

                const zoomFactor = 1.5;
                img.style.transformOrigin = `${(left + lensWidth) / box.offsetWidth * 100}% ${(top + lensHeight) / box.offsetHeight * 100}%`;
                img.style.transform = `scale(${zoomFactor})`;
            }

            box.addEventListener("mousemove", moveLens);

            box.addEventListener("mouseenter", () => {
                lens.style.display = "block";
                img.style.transform = "scale(2)"; // Ajuste o fator de zoom conforme necessário
            });

            box.addEventListener("mouseleave", () => {
                lens.style.display = "none";
                img.style.transform = "scale(1)";
            });
        });
    </script>

</body>

</html>