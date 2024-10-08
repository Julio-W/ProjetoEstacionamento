<?php
include("php/config/database.php");
session_start();

if (empty($_SESSION['logado'])) {
    header("Location: ../../Login/index.php");
    exit();
}
include("php/models/vaga.php");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reservar Vaga</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta charset="UTF-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Autocomplete Endereço</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
    <script src="js/scripts.js" defer></script>
</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="vLogo">
                    <a href="../index.php" class="seta"><img src="../images/botao-de-seta-para-a-esquerda-do-teclado.png" alt=""></a>
                    <div class="login100-pic js-tilt" data-tilt>
                        <a href="../../index.html"><img src="../images/logo escrita sem fundo.png" alt="IMG" class="logoL"></a>
                        <a href="../../index.html"><img src="../images/texto-logo.png" alt="IMG" class="logoE"></a>
                    </div>
                </div>

                <form class="login100-form validate-form" submit="../FormVaga/index.php" method="post">
                    <span class="login100-form-title">
                        Reserva de Vaga
                    </span>

                    <!-- Inclusão do jQuery -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                    <div class="wrap-input100 validate-input">
                        <select class="input100" name="estado" id="estado" required>
                            <option value="" disabled selected>Selecione o estado</option>
                            <option value="AC">AC - Acre</option>
                            <option value="AL">AL - Alagoas</option>
                            <option value="AP">AP - Amapá</option>
                            <option value="AM">AM - Amazonas</option>
                            <option value="BA">BA - Bahia</option>
                            <option value="CE">CE - Ceará</option>
                            <option value="DF">DF - Distrito Federal</option>
                            <option value="ES">ES - Espírito Santo</option>
                            <option value="GO">GO - Goiás</option>
                            <option value="MA">MA - Maranhão</option>
                            <option value="MT">MT - Mato Grosso</option>
                            <option value="MS">MS - Mato Grosso do Sul</option>
                            <option value="MG">MG - Minas Gerais</option>
                            <option value="PA">PA - Pará</option>
                            <option value="PB">PB - Paraíba</option>
                            <option value="PR">PR - Paraná</option>
                            <option value="PE">PE - Pernambuco</option>
                            <option value="PI">PI - Piauí</option>
                            <option value="RJ">RJ - Rio de Janeiro</option>
                            <option value="RN">RN - Rio Grande do Norte</option>
                            <option value="RS">RS - Rio Grande do Sul</option>
                            <option value="RO">RO - Rondônia</option>
                            <option value="RR">RR - Roraima</option>
                            <option value="SC">SC - Santa Catarina</option>
                            <option value="SP">SP - São Paulo</option>
                            <option value="SE">SE - Sergipe</option>
                            <option value="TO">TO - Tocantins</option>
                        </select>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <select class="input100" name="cidade" id="cidade" disabled required>
                            <option value="">Carregando cidades...</option>
                        </select>
                        <span class="focus-input100"></span>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#estado').change(function() {
                                var estado = $(this).val();
                                $('#cidade').html('<option value="">Carregando cidades...</option>');
                                $('#cidade').prop('disabled', true);
                                $.ajax({
                                    url: "php/models/cidade.php",
                                    data: { estado: estado },
                                    success: function(data) {
                                        $('#cidade').html(data);
                                        $('#cidade').prop('disabled', false);
                                    }
                                });
                            });
                        });
                    </script>

                    <div class="wrap-input100 validate-input">
                        <select class="input100" name="estacionamento" id="estacionamento" disabled required>
                            <option value="">Selecione a cidade</option>
                        </select>
                        <span class="focus-input100"></span>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#estado').change(function() {
                                var estado = $(this).val();
                                $('#cidade').html('<option value="">Carregando cidades...</option>');
                                $('#cidade').prop('disabled', true);
                                $.ajax({
                                    url: "buscar_cidades.php",
                                    data: { estado: estado },
                                    success: function(data) {
                                        $('#cidade').html(data);
                                        $('#cidade').prop('disabled', false);
                                    }
                                });
                            });

                            $('#cidade').change(function() {
                                var cidade = $(this).val();
                                $('#estacionamento').html('<option value="">Carregando estacionamentos...</option>');
                                $('#estacionamento').prop('disabled', true);
                                $.ajax({
                                    url: "php/models/estacionamento.php",
                                    data: { cidade: cidade },
                                    success: function(data) {
                                        $('#estacionamento').html(data);
                                        $('#estacionamento').prop('disabled', false);
                                    }
                                });
                            });
                        });
                    </script>

                    <div class="wrap-input100 validate-input">
                        <select class="input100" name="modelo" required>
                            <option value="" disabled selected>Tipo de veículo</option>
                            <option value="carro">Carro</option>
                            <option value="moto">Moto</option>
                            <option value="caminhao">Caminhão</option>
                            <option value="outro">Outro</option>
                        </select>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="placa" placeholder="Placa" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="nomeinput">
            Horário de entrada
          </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="time" name="entrada" placeholder="Horário de entrada" required>
                        <span class="focus-input100"></span>
                    </div>


                    <div class="nomeinput">
            Horário de saida
          </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="time" name="saida" placeholder="Horário de saída" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="nomeinput">
            Data da reserva
            </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="date" name="data" placeholder="Data" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="nomeinput">
            Uso de vaga preferencial
         
                    <div class="form-check form-check-inline">
                        <input type="radio" id="preferencial_sim" name="preferencial" value="1" required>
                        <label for="preferencial_sim">Sim</label><br>
                        <input type="radio" id="preferencial_nao" name="preferencial" value="0">
                        <label for="preferencial_nao">Não</label>
                    </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
