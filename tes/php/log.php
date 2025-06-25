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
    <h2>Registro de Log</h2>

    <div class="log-container">
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "pedrinho13";
        $dbname = "zero21";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Consulta de registros de log
        $sql = "SELECT * FROM log";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Ação</th><th>Data e Hora</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id_log"] . "</td><td>" . $row["acao"] . "</td><td>" . $row["data_hora"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum registro de log encontrado.";
        }

        $conn->close();
        ?>
    </div>
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