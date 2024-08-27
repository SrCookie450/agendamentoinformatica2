<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');

   $data = $_POST['data'];
   $id_lab = $_POST['id_lab'];

    
   $separa = explode('/',$data);
   $dia_mes = $separa[0];
   $mes = $separa[1];
   $ano = $separa[2];
   $nova_data = $mes.'/'.$dia_mes.'/'.$ano;
  $dia_semana = 0;
  $dia = date("l", strtotime($nova_data));
   if($dia == 'Monday'){
       $dia_semana = 2;
   }elseif($dia == 'Tuesday'){
       $dia_semana = 3;
   }elseif($dia == 'Wednesday'){
    $dia_semana = 4;
   }elseif($dia == 'Thursday'){
    $dia_semana = 5;
    }elseif($dia == 'Friday'){
    $dia_semana = 6;
    }
     
  echo $dia;
?>

<style>
    input[type="checkbox"] {
       
        width: 20px;
        height: 20px;
        
        }
</style>

<br>Selecione os horários disponíveis ou faça o cancelamento para o dia <b><?php echo $dia_mes.'/'.$mes.'/'.$ano ?></b>:<br>


<ul data-role="tabs" data-expand="true">
    <li><a href="#" class="mat">MATUTINO</a></li>
    <li><a href="#" class="vesp">VESPERTINO</a></li>
    <li><a href="#" class="not">NOTURNO</a></li>
</ul>
    

<div class="painel1 p-4" >
   
    <?php
            $lista2 = $mysqli->query("SELECT * FROM cad_horario WHERE  turno = 'M' and  id_lab = '$id_lab' and dia = '$dia_semana' ORDER BY horario ");
            while($dados = $lista2->fetchArray()){
                $d = $dados['dia'];
                $horario = $dados['horario'];
                $separa = explode(' ',$horario);
                $checado = '';
                $disable = '';
                $mensagem = '';
                $conta_registros = 0;
                $lista3 = $mysqli->query("SELECT * FROM cad_reserva WHERE  turno = 'M' and  id_lab = '$id_lab' and dia_mes = '$dia_mes' and mes = '$mes' and ano = '$ano' and horario = '$horario' ");
                while($dados3 = $lista3->fetchArray()){
                    $id_professor = $dados3['usuario'];
                    $lista = $mysqli->query("SELECT * FROM cad_professores  WHERE id = '$id_professor'");
                    $dados = $lista->fetchArray();
                    $nome_usuario = $dados['nome'];
                   
                    $conta_registros++
;                }
                

               
                if($conta_registros > 0){
                    $checado = 'checked';
                    $disable = 'disabled'; 
                    $mensagem = $nome_usuario;
                }

               
                ?>
                <label class="">
                    <input <?php echo $checado ?>  name='checks' value="<?php echo $horario ?>" type="checkbox" class="confere" >
                    <?php echo $horario ?>
                    <span class="M<?php echo $separa[0] ?>"> <?php echo $mensagem ?></span>
                    
                </label>
                <br>
                <?php
            }

            ?>  
    </div>
    <div class="painel2 p-4" >
    <?php
                $lista2 = $mysqli->query("SELECT * FROM cad_horario WHERE  turno = 'V' and  id_lab = '$id_lab' and dia = '$dia_semana' ORDER BY horario ");
                
                while($dados = $lista2->fetchArray()){
                    $d = $dados['dia'];
                    $horario = $dados['horario'];
                    $separa = explode(' ',$horario);
                    $checado = '';
                    $disable = '';
                    $mensagem = '';
                    $conta_registros = 0;
                    $lista3 = $mysqli->query("SELECT * FROM cad_reserva WHERE  turno = 'V' and  id_lab = '$id_lab' and dia_mes = '$dia_mes' and mes = '$mes' and ano = '$ano' and horario = '$horario' ");
                    while($dados3 = $lista3->fetchArray()){
                        $id_professor = $dados3['usuario'];
                        $lista = $mysqli->query("SELECT * FROM cad_professores  WHERE id = '$id_professor'");
                        $dados = $lista->fetchArray();
                        $nome_usuario = $dados['nome'];
                       
                        $conta_registros++
    ;                }
                    if($conta_registros > 0){
                        $checado = 'checked';
                        $disable = 'disabled'; 
                        $mensagem =  $nome_usuario;
                    }

                    ?>
                    <label class="">
                        <input <?php echo $checado ?>  name='checks' value="<?php echo $horario ?>" type="checkbox" class="confere" >
                        <?php echo $horario ?>
                        <span class="V<?php echo$separa[0] ?>"> <?php echo $mensagem ?></span>
                    </label>
                    <br>
                    <?php
                }

                ?> 
    </div>
    <div class="painel3 p-4" >
    <?php
                    $lista2 = $mysqli->query("SELECT * FROM cad_horario WHERE  turno = 'N' and  id_lab = '$id_lab' and dia = '$dia_semana' ORDER BY horario ");
                    while($dados = $lista2->fetchArray()){
                        $d = $dados['dia'];
                        $horario = $dados['horario'];
                        $separa = explode(' ',$horario);
                        $checado = '';
                        $disable = '';
                        $mensagem = '';
                        $conta_registros = 0;
                        $lista3 = $mysqli->query("SELECT * FROM cad_reserva WHERE  turno = 'N' and  id_lab = '$id_lab' and dia_mes = '$dia_mes' and mes = '$mes' and ano = '$ano' and horario = '$horario' ");
                        while($dados3 = $lista3->fetchArray()){
                            $id_professor = $dados3['usuario'];
                            $lista = $mysqli->query("SELECT * FROM cad_professores  WHERE id = '$id_professor'");
                            $dados = $lista->fetchArray();
                            $nome_usuario = $dados['nome'];
                           
                            $conta_registros++
        ;                }
                        if($conta_registros > 0){
                            $checado = 'checked';
                            $disable = 'disabled'; 
                            $mensagem =  $nome_usuario;
                        }
                        ?>
                        <label class="">
                            <input <?php echo $checado ?>  name='checks' value="<?php echo $horario ?>" type="checkbox" class="confere" >
                            <?php echo $horario ?>
                            <span class="N<?php echo $separa[0] ?>"> <?php echo $mensagem ?></span>
                        </label>
                        <br>
                        <?php
                    }

                    ?>  
    </div>
</div>

</div>
    
<br>


<script>
    $(function(){
        $('.painel1').show();
        $('.painel2').hide();
        $('.painel3').hide();
        turno = 'M';
        $('.mat').click(function(){
            $('.painel1').show();
            $('.painel2').hide();
            $('.painel3').hide();
            turno = 'M'
        })
        $('.vesp').click(function(){
            $('.painel1').hide();
            $('.painel2').show();
            $('.painel3').hide();
            turno = 'V'
        })
        $('.not').click(function(){
            $('.painel1').hide();
            $('.painel2').hide();
            $('.painel3').show();
            turno = 'N'
        })
       
        $('.confere').change(function(){
            tempo = $(this).val();

            valor = 0
            if($(this).is(":checked")) {
                valor = 1
                } else {
                valor = 0
                }
                   
            dia_mes = '<?php echo $dia_mes ?>';
            dia_semana = '<?php echo $dia_semana ?>';
            ano = '<?php echo $ano ?>';
            mes = '<?php echo $mes ?>';
            id_lab = '<?php echo $id_lab ?>';
            usuario = $('#professor').val();
            motivo = $('#motivo').val();
            horarios = $(this).val();

            resultado = horarios.split(" ");
            

           if(usuario == '' || motivo == ''){
                alert("Selecione um professor e descreva o motivo!");
                data = $('#datepicker').val();
                $.ajax({
                    type: 'POST',
                    url: 'agendamento/ver_horario.php',
                    data: {'data':data,'id_lab':id_lab  },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                      
                      $('.ver_horarios').html(data);  

                    }
                })
               
           }else{

           
            $.ajax({
                    type: 'POST',
                    url: 'agendamento/salva_reserva.php',
                    data: {'horarios':horarios,'id_lab':id_lab,'dia_mes':dia_mes,'dia_semana':dia_semana,'ano':ano,'mes':mes,'usuario':usuario,'motivo':motivo,'valor':valor,'turno': turno },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                        var texto = $('#professor :selected').text();                        
                        par = '.'+turno+resultado[0]
                       if(data == 1 && valor == 1){
                        
                        
                       $(par).text(texto);
                       }else if(data == 1 && valor == 0){
                        $(par).text(' ');
                       }else{
                        
                           alert(data);
                       }
                                     
                    

                    }
                })

            }
        })
    })
</script>

