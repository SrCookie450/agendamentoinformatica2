<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../arquivos/metro/css/metro-all.css?ver=@@b-version" rel="stylesheet">
    <link rel="stylesheet" href="../js/jqueyui/jquery-ui.css">
    <script src="../arquivos/metro/js/metro.js?ver=@@b-version"></script>
    <script src="../js/jquery.js"></script>
    
    <script src="../js/jqueyui/jquery-ui.js"></script>
    <script src="../js/jqueyui/jquery.ui.touch-punch.js"></script>
    <title>Agendamento</title>
    <style>
         body {
                background-image: url('../images/fundo2.jpg');
                background-size: cover;
                background-repeat: no-repeat;
            }
        .center-div {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            }
           

                
    </style>

<body>



<div class="container-fluid pos-fixed fixed-top z-top bg-light fg-black" id="header">

<header class="app-bar container bg-transparent fg-black pos-relative app-bar-expand" data-role="appbar" data-expand-point="md" data-role-appbar="true"><button type="button" class="hamburger menu-down dark hidden"><span class="line"></span><span class="line"></span><span class="line"></span></button>

    <ul class="app-bar-menu ">
       <li><a href="../index.php">Retornar</a></li>
        <li>
            <a href="#" class="dropdown-toggle">Cadastros</a>
            <ul class="d-menu" data-role="dropdown">                
                <li ><a href="#" class="cad_lab">Cad_laboratório</a></li>
                <li><a href="#" class="cad_horario">Cad_horários</a></li>
                <li><a href="#" class="professores">Cad_professores</a></li>
            </ul>
        
        </li>
        <li><a href="#" class="relatorios">Relatórios</a></li>
        <li><a href="#" class="agendamento">Agendamento</a></li>
        
        <li><a href="#" class="creditos">Créditos</a></li>
    </ul>

    </header>   
</div>
<div class="corpo " style="padding-top: 50px;"></div>
   
<script>
    
    $(function(){

        $('.cad_lab').click(function(a){
            a.preventDefault();

            $('.corpo').load('configuracao/laboratorio.php');
            $('.center-div').hide();

        })
        $('.professores').click(function(e){
            e.preventDefault();
            $('.corpo').load('professores/painel.php');
            $('.center-div').hide();

        })
        
        $('.cad_horario').click(function(e){
            e.preventDefault();
            $('.corpo').load('agenda/painel.php');
            $('.center-div').hide();

        })
        $('.agendamento').click(function(e){
            e.preventDefault();
            $('.corpo').load('agendamento/painel.php');
            $('.center-div').hide();

        })
        $('.relatorios').click(function(e){
            e.preventDefault();
            $('.corpo').load('relatorios/painel.php');
            $('.center-div').hide();

        })
        $('.creditos').click(function(e){
            e.preventDefault();
            $('.corpo').load('creditos/painel.php');
            $('.center-div').hide();

        })
    })
</script>
</body>
</html>