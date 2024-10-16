<?php
session_start();

include("php/config/database.php");

  if ($_SESSION['logado'] === false || $_SESSION['logado'] === null ) {
   
    
    // Redireciona para a página padrão após o cadastro bem-sucedido
    header("Location: ../Login/index.php");
    exit();}

    if (isset($_GET['redirecionado']) && $_GET['redirecionado'] === 'sim') {
    echo "<script>alert('Privilégio para acesso inválido');</script>";

}


$idUsuario = $_SESSION["usuario_id"];

// Query para buscar o nome completo do usuário
$sql = "SELECT nome FROM usuario WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $idUsuario); // Bind do ID do usuário
    $stmt->execute();
    $stmt->bind_result($nomeCompleto); // Vincula a variável para o resultado

    // Executa a consulta e obtém o resultado
    if ($stmt->fetch()) {
        // Divide o nome completo em partes e pega o primeiro nome
        $partesNome = explode(" ", $nomeCompleto);
        $primeiroNome = $partesNome[0];}}
//teste para ver se a classe é igual a true
      //  if ($_SESSION['classe'] === true) {
      //      echo '<script>alert("O Valor é válido")</script>';
      //      # code...
      //  }



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
    <title>SmartPark</title>
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
                    <a href="#menu">Estacionamentos</a>
                </li>
                <li class="nav-item">
                    <a href="#testimonials">Avaliações</a>
                </li>
                <li class="nav-item">
                    <a href="../Página Principal/index.php">Página cliente</a>
                </li>
                <li class="nav-item">
                    <a href="../Painel de controle/index.php">Página empresa</a>
                </li>
            </ul>

            <a href="../Registro/index.php" ><button class="btn-default" >
                Atualizar cadastro
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
                    <a href="#menu">Estacionamentos</a>
                </li>
                <li class="nav-item">
                    <a href="#testimonials">Avaliações</a>
                </li>
                <li class="nav-item">
                    <a href="../Página Principal/index.php">Página Principal</a>
                </li>
            </ul>

            <a href="../Registro/index.php"><button class="btn-default">
               
                Concluir cadastro
            </button></a>
        </div>
    </header>

    <main id="content">
        <section id="home">
            <div class="shape"></div>
            <div id="cta">
                <h1 class="title">
                    Os
                    <span>melhores</span>
                    estacionamentos <span>direto</span> na sua tela
                </h1>

                <?php 
                if ($nomeCompleto!=null) {
                   echo '<p class="description">
                        Entre em contato, '.$primeiroNome.' 
                        </p>';
                }
                else {
                     echo '<p class="description">
                    Entre em contato
                    </p>';}
                
                ?>

                <div id="cta_buttons">
                    <a href="#menu" class="btn-default">
                        Estacionamentos
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
        <h2 class="section-title">Locais</h2>
        <h3 class="section-subtitle">Esatacionamentos parceiros</h3>

        <div id="dishes">
            <div class="dish">

                <p>Lava Jato Lider</p>
            
                <span>
                    <img class="plano" src="../images/maps1.png" alt="Plano Ultimate+">
                </span>

                <div class="dish-rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span>(500+)</span>
                </div>

                <div class="dish-price">
                    <a target="_blank" class="lp" href="https://maps.app.goo.gl/oes6a8XPvnEQPNAUA"><button class="btn-default">Abrir no mapa</button></a>
                </div>
            </div>

            <div class="dish">

                <p>Park Ok</p>

                <span>
                    <img class="plano" src="../images/maps2.png" alt="Plano Ultimate+">
                </span>

                <div class="dish-rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span>(500+)</span>
                </div>

                <div class="dish-price">
                    <a target="_blank" class="lp" href="https://maps.app.goo.gl/ysfLfTeLoFKsfg9M9"><button class="btn-default">Abrir no mapa</button></a>
                </div>
            </div>

            <div class="dish">

                <p>Socomil</p>
                
                <span>
                    <img class="plano" src="../images/maps3.png" alt="Plano Ultimate+">
                </span>

                <div class="dish-rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span>(500+)</span>
                </div>

                <div class="dish-price">
                    <a target="_blank" class="lp" href="https://maps.app.goo.gl/6kN8Pw3nmQfcZqfKA"><button class="btn-default">Abrir no mapa</button></a>
                </div>
            </div>
            <div class="dish">

                <p>Park.Me</p>
                
                <span>
                    <img class="plano" src="../images/maps4.png" alt="Plano Ultimate+">
                </span>

                <div class="dish-rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span>(500+)</span>
                </div>

                <div class="dish-price">
                    <a target="_blank" class="lp" href="https://maps.app.goo.gl/zE61ZVwjrkETeviZ8"><button class="btn-default">Abrir no mapa</button></a>
                </div>
            </div>
            <div class="dish">

                <p>One Parking</p>
                
                <span>
                    <img class="plano" src="../images/maps5.png" alt="Plano Ultimate+">
                </span>

                <div class="dish-rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span>(500+)</span>
                </div>

                <div class="dish-price">
                    <a target="_blank" class="lp" href="https://maps.app.goo.gl/Uavk1efbGezaWJkc7"><button class="btn-default">Abrir no mapa</button></a>
                   
                </div>
            </div>
    </section>
    <a class="lp" href="FormVaga/index.php" style="display: flex; justify-content: center; align-items: center; text-align: center;">
    <button class="btn-default" style="padding: 10px 20px; box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);">
        Garantir Vaga
    </button>
</a>




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
