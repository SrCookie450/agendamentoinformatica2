<?php
// Obtém o nome do usuário logado no Windows
$username = trim(shell_exec('echo %USERNAME%'));
?>

<!DOCTYPE html>

<html lang="py-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="arquivos/metro/css/metro-all.css?ver=@@b-version" rel="stylesheet">
    <script src="arquivos/metro/js/metro.js?ver=@@b-version"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jqueyui/jquery-ui.js"></script>
    <script src="js/jqueyui/jquery.ui.touch-punch.js"></script>
    <title>Agendamento de Laboratórios Escolares - Clodonil Cardoso</title>
    <style>
        body {
                background-image: url('images/fundo.jpg');
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
</head>
<body>
    
<div class="corpo"></div>
   <div class="center-div">
        <center>
        <div class="img-container" style="width: 50%">
        <img src="images/lab_comp.png" style="width: 100%">
        </div>
        <h3>
        Bem-vindo, <?php echo htmlspecialchars($username); ?>.
        </h3>

        <a href="admin/painel.php" class="button primary large ">Entrar</a>
        
        </center>
    </div>

</body>
</html>

<script>
    $(function(){
        $('.aumentar').click(function(e){
           //para fechar o aplicativo
            //window.close() 
        })
    })
</script>