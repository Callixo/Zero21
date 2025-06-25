<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Consulta de Usuários</title>
    <link rel="stylesheet" href="../globals.css">
</head>
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
    <h2>Consulta de Usuários</h2>

    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Pesquisar por Nome ou CPF: <input type="text" name="query">
        <input type="submit" value="Pesquisar">
    </form>

    <div class="table-container">
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

        // Lógica de pesquisa
        if (isset($_GET['query'])) {
            $search_query = $_GET['query'];
            $sql = "SELECT id, nome_completo, data_nascimento, nome_materno, cpf, genero, telefone_celular, nome_usuario, email, cep, rua, complemento, bairro, cidade, estado FROM dados_pessoais WHERE nome_completo LIKE '%$search_query%' OR cpf LIKE '%$search_query%'";
        } else {
            $sql = "SELECT id, nome_completo, data_nascimento, nome_materno, cpf, genero, telefone_celular, nome_usuario, email, cep, rua, complemento, bairro, cidade, estado FROM dados_pessoais";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Data de Nascimento</th><th>Nome Materno</th><th>CPF</th><th>genero</th><th>telefone_celular</th><th>nome_usuario</th><th>email</th><th>cep</th><th>rua</th><th>complemento</th><th>bairro</th><th>cidade</th><th>estado</th><th>Ações</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nome_completo"] . "</td><td>" . $row["data_nascimento"] . "</td><td>" . $row["nome_materno"] . "</td><td>" . $row["cpf"] . "</td><td>" . $row["genero"] . "</td><td>" . $row["telefone_celular"] . "</td><td>" . $row["nome_usuario"] . "</td><td>" . $row["email"] . "</td><td>" . $row["cep"] . "</td><td>" . $row["rua"] . "</td><td>" . $row["complemento"] . "</td><td>" . $row["bairro"] . "</td><td>" . $row["cidade"] . "</td><td>" . $row["estado"] . "</td><td><button class='excluir' onclick='excluirUsuario(" . $row["id"] . ")'>Excluir</button></td></tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum Usuário encontrado.";
        }

        $conn->close();
        ?>
    </div>

    <script>
        function excluirUsuario(userId) {
            if (confirm("Tem certeza que deseja excluir este usuário?")) {
                // Envia a requisição para excluir o usuário
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Recarrega a página após a exclusão
                        location.reload();
                    }
                };
                xhttp.open("GET", "excluir_usuario.php?id=" + userId, true);
                xhttp.send();
            }
        }

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