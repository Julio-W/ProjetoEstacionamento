<?php
session_start();
include "php/config/database.php";

// Verifica se o usuário tem acesso de gerente
if ($_SESSION['classe'] === false || $_SESSION['classe'] === null) {
    header("Location: ../Página Principal/index.php?redirecionado=sim");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Consulta SQL para verificar se o ID do usuário é gerente de algum estacionamento
$sql = "SELECT id, Nome, QuantidadeDeVagas, VagasPreferenciais, LimiteComum, LimitePreferencial 
        FROM estacionamento 
        WHERE gerente = ?";

// Preparar a declaração SQL
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $stmt->bind_result($estacionamento_id, $Nome, $QuantidadeDeVagas, $VagasPreferenciais, $LimiteComum, $LimitePreferencial);
    if ($stmt->fetch()) {
        // Fechar o primeiro $stmt antes de executar novas consultas
        $stmt->close();

        // Consulta SQL para contar as vagas comuns válidas para hoje e no estacionamento do gerente
        $sqlVagasComuns = "SELECT COUNT(*) FROM vaga WHERE Validade = 1 AND Preferencial = 0 AND Data = CURDATE() AND Estacionamento = ?";
        if ($stmtComum = $conn->prepare($sqlVagasComuns)) {
            $stmtComum->bind_param("i", $estacionamento_id); // Filtra pelo estacionamento gerenciado
            $stmtComum->execute();
            $stmtComum->bind_result($vagasComunsOcupadas);
            $stmtComum->fetch();
            $stmtComum->close();
        }

        // Consulta SQL para contar as vagas preferenciais válidas para hoje e no estacionamento do gerente
        $sqlVagasPreferenciais = "SELECT COUNT(*) FROM vaga WHERE Validade = 1 AND Preferencial = 1 AND Data = CURDATE() AND Estacionamento = ?";
        if ($stmtPreferencial = $conn->prepare($sqlVagasPreferenciais)) {
            $stmtPreferencial->bind_param("i", $estacionamento_id); // Filtra pelo estacionamento gerenciado
            $stmtPreferencial->execute();
            $stmtPreferencial->bind_result($vagasPreferenciaisOcupadas);
            $stmtPreferencial->fetch();
            $stmtPreferencial->close();
        }

        // Cálculo das vagas disponíveis
        $vagasComunsDisponiveis = $LimiteComum - $vagasComunsOcupadas;
        $vagasPreferenciaisDisponiveis = $LimitePreferencial - $vagasPreferenciaisOcupadas;
    } else {
        // Nenhum estacionamento gerenciado por este usuário
        $Nome = "null";
        $QuantidadeDeVagas = "null";
        $VagasPreferenciais = "null";
        $LimiteComum = "null";
        $LimitePreferencial = "null";
        $vagasComunsDisponiveis = "null";
        $vagasPreferenciaisDisponiveis = "null";
        
        // Fechar o $stmt caso não seja encontrado nenhum resultado
        $stmt->close();
    }
}
?>

                                                             
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/scrollreveal"></script>
        <title>SmartPark - Painel</title>
    </head>
    <body>
        <header>
            <nav id="navbar">
                    <picture>
                        <a href="../index.html"><img src="images/logo_smart_parker-media.png" alt="" class="logo"></a>
                    </picture>
            

                <ul id="nav_list">
                    <li class="nav-item active">
                        <a href="#home">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a href="Form dados/index.php">Dados do estacionamento</a>
                    </li>
                    <li class="nav-item">
                        <a href="#menu">Status</a>
                    </li>
                    <li class="nav-item">
                        <a href="#testimonials">Avaliações</a>
                    </li>
                    <li class="nav-item">
                        <a href="../Página Principal/index.php">Página cliente</a>
                    </li>
                </ul>

                <a href="../Registro/Gerente/index.php" ><button class="btn-default" >
                    Trocar gerente
                </button></a>

                <button id="mobile_btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </nav>

            <div id="mobile_menu">
                <ul id="mobile_nav_list">
                    <li class="nav-item">
                        <a href="#home">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.html">Dados do estacionamento</a>
                    </li>
                    <li class="nav-item">
                        <a href="#menu">Status</a>
                    </li>
                    <li class="nav-item">
                        <a href="#testimonials">Avaliações</a>
                    </li>
                    <li class="nav-item">
                        <a href="../Página Principal/index.html">Voltar a página Principal</a>
                    </li>
                </ul>

                <a href="../Registro/Gerente/index.php"><button class="btn-default">
                    Concluir cadastro
                </button></a>
            </div>
        </header>

        <main id="content">
            <section id="home">
                <div class="shape"></div>
                <div id="cta">
                    <h1 class="title">
                        Por aqui <br>
                        <span>você</span>
                        controla <br> <span>tudo</span> do seu estacionamento
                    </h1>

                    <p class="description">
                        Entre em contato
                    </p>

                    <div id="cta_buttons">
                        <a href="#menu" class="btn-default">
                            Status
                        </a>

                        <a href="tel:+55555555555" id="phone_button">
                            <button class="btn-default">
                                <i class="fa-solid fa-phone"></i>
                            </button>
                            (11) 4002-8922
                        </a>
                    </div>

                    <div class="social-media-buttons">
                        <a target="_blank" href="https://wa.me/+553899277387">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>

                        <a target="_blank" href="https://www.instagram.com/joao_italo__/?hl=pt">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a target="_blank" href="https://www.facebook.com/">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </div>
                </div>

                <div id="banner">
                    <img src="images/car.png" alt="">
                </div>
            </section>

        <section id="menu">
            <h2 class="section-title">Status</h2>
            <h3 class="section-subtitle">Veja aqui tudo sobre o seu estacionamento</h3>

            <div id="dishes">
                <div class="dish">
                    <p>Nome:<?php echo "</br> $Nome"?></p>
                </div>
                <div class="dish">
                    <p>Vagas:<?php echo "</br> $QuantidadeDeVagas"?> </p>
                </div>
                <div class="dish">
                    <p>Vagas totais preferênciais:<?php echo "</br> $VagasPreferenciais"?></p>
                </div>
                <div class="dish">
                    <p>Vagas comuns disponíveis: <?php echo $vagasComunsDisponiveis; ?></p>
                </div>
                <div class="dish">
                    <p>Vagas preferenciais disponíveis: <?php echo $vagasPreferenciaisDisponiveis; ?></p>
                </div>

            </section>   
            
            <section id="menu">
            <h2 class="section-title">Gerenciamento de Vagas</h2>
            <h3 class="section-subtitle">Altere e controle as vagas do estacionamento</h3>
            <br>

            <div class="tabela">

        
    <!-- Aqui fica presente todo o código para a tabela de ver e controlar a vaga-->
    <?php include "php/models/vaga.php" ?> </div>

    </section>  
    

        <section id="testimonials">
            <img src="images/pensativo.png" id="testimonial_chef" alt="">

            <div id="testimonials_content">
                <h2 class="section-title">
                    Avaliações
                </h2>
                <h3 class="section-subtitle">
                    O que os clientes falam sobre nós
                </h3>

                <div id="feedbacks">
                    <div class="feedback">
                        <img src="images/avatar.png" class="feedback-avatar" alt="">

                        <div class="feedback-content">
                            <p>
                                Fulanos de Tal
                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            </p>
                            <p>
                                "Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Repellat voluptatibus cumque dolor ea est quae alias necessitatibus"
                            </p>
                        </div>
                    </div>

                    <div class="feedback">
                        <img src="images/avatar2.jpeg" class="feedback-avatar" alt="">

                        <div class="feedback-content">
                            <p>
                                Fulana de Tal
                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            </p>
                            <p>
                                "Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Repellat voluptatibus cumque dolor ea est quae alias necessitatibus"
                            </p>
                        </div>
                    </div>
                </div>

                <a href="https://www.reclameaqui.com.br/empresa/rede-globo/" style="text-decoration: none;" target="_blank"><button class="btn-default">
                    Ver mais avaliações
                </button></a>
            </div>
        </section>

        
        <footer>
            <img src="images/wave.svg" alt="">

            <div id="footer_items">
                <span id="copyright">
                    &copy 2024 J&J TECH
                </span>

                <div class="social-media-buttons">
                    <a href="https://wa.me/+553899277387">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>

                    <a href="https://www.instagram.com/joao_italo__/?hl=pt">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://www.facebook.com/">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                </div>
            </div>
        </footer>
        <script src="javascript/script.js"></script>
    </body>
    </html>
