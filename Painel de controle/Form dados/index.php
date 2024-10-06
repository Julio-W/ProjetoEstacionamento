<?php
session_start();
include 'php/config/database.php';


// Verificar se o usuário está logado
if ($_SESSION['logado'] === false || $_SESSION['logado'] === null ) {
   
    
  // Redireciona para a página padrão após o cadastro bem-sucedido
  header("Location: ../../Login/index.php");
  exit();}


if ($_SESSION['classe'] === false || $_SESSION['classe'] === null ) {
   
    
  // Redireciona para a página padrão se não for gerente
 header("Location: ../../Página Principal/index.php?redirecionado=sim");
  exit();
}
include"php/models/salvar_endereco.php";
include "php/models/salvar_estacionamento.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Atualizar dados</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Autocomplete Endereço</title>
    <link rel="stylesheet" href="css/styles.css" />
    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <!-- Bootstrap icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css"
    />
    <script src="js/scripts.js" defer></script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="vLogo">
				<a href="../index.php" class="seta"><img src="../images/botao-de-seta-para-a-esquerda-do-teclado.png" alt=""></a>
				<div class="login100-pic js-tilt" data-tilt>
					<a href="../../index.html" ><img src="../images/logo escrita sem fundo.png" alt="IMG" class="logoL"></a>
					<a href="../../index.html" ><img src="../images/texto-logo.png" alt="IMG" class="logoE"></a>
				</div>
			</div>

				<form class="login100-form validate-form" id="formEstacionamento" method="post" action="../Form dados/index.php">
					<span class="login100-form-title">
						Dados do estacionamento
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nome" placeholder="Nome">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" name="vagas" placeholder="Vagas">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" name="vagasP" placeholder="Vagas preferênciais">
						<span class="focus-input100"></span>
					</div>
          <div class="texto1">
          <p>Horario de abertura</p>
          </div>
          <div class="wrap-input100 validate-input">
						<input class="input100" type="time" name="horaA" placeholder="Horário de abertura">
						<span class="focus-input100"></span>
					</div>
          <div class="texto1">
            <p>Horario de fechamento</p>
            </div>
          <div class="wrap-input100 validate-input">
						<input class="input100" type="time" name="horaF" placeholder="Horario de fechamento">
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
			<a  ><button id="submitButton" type="submit" class="login100-form-btn">Confirmar</button></a>
		</div>
					</form>	

					
    
  
    <div id="fade" class="hide">
      <div id="loader" class="spinner-border text-info hide" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <div id="message" class="hide">
        <div class="alert alert-light" role="alert">
          <h4>Mensagem:</h4>
          <p></p>
          <button id="close-message" type="button" class="btn btn-secondary">
            Fechar
          </button>
        </div>
      </div>
    </div>
    <div id="order-form-container" class="container p-6 my-md-4 px-md-0">
      <div id="steps" class="mb-md-3 pb-md-3">
        <div class="line"></div>  
        
      </div>
      <div id="form-header">
        <h2>Coloque o endereço do seu estacionamento</h2>
      </div>
      <form id="address-form" method="post" action="../Form dados/index.php" > 
        <div class="row mb-3">
          <div class="form-floating">
            <input
              type="text"
              class="form-control shadow-none"
              id="cep"
              name="cep"
              placeholder="Digite o seu CEP"
              maxlength="8"
              minlength="8"
              required
            />
            <label for="cep">Digite o seu CEP</label>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12 col-sm-6 mb-3 mb-md-0 form-floating">
            <input
              type="text"
              class="form-control shadow-none"
              id="address"
              name="address"
              placeholder="Rua"
              disabled
              required
              data-input
            />
            <label for="address">Rua</label>
          </div>
          <div class="col-12 col-sm-6 form-floating">
            <input
              type="text"
              class="form-control shadow-none"
              id="number"
              name="number"
              placeholder="Digite o número da residência"
              disabled
              required
              data-input
            />
            <label for="number">Digite o número</label>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12 col-sm-6 mb-3 mb-md-0 form-floating">
            <input
              type="text"
              class="form-control shadow-none"
              id="complement"
              name="complement"
              placeholder="Digite o complemento"
              disabled
              data-input
            />
            <label for="complement">Digite o complemento</label>
          </div>
          <div class="col-12 col-sm-6 form-floating">
            <input
              type="text"
              class="form-control shadow-none"
              id="neighborhood"
              name="neighborhood"
              placeholder="Bairro"
              disabled
              required
              data-input
            />
            <label for="neighborhood">Bairro</label>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12 col-sm-6 mb-3 mb-md-0 form-floating">
            <input
              type="text"
              class="form-control shadow-none"
              id="city"
              name="city"
              placeholder="Cidade"
              disabled
              required
              data-input
            />
            <label for="city">Cidade</label>
          </div>
          <div class="col-12 col-sm-6 mb-3">
            <select
              class="form-select shadow-none"
              id="region"
              name="region"
              disabled
              required
              data-input
            >
              <option selected>Estado</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
            </select>
          </div>
        </div>
        <div class="container-login100-form-btn">
			<a  ><button id="submitButton" type="submit" class="login100-form-btn">Confirmar</button></a>
		</div>
      </form>
    </div>

    
  


				
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
 

</body>
</html>