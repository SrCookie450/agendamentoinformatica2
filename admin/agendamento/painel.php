<br>
<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');

?>
<style>
    input[type=text], select,input[type=number] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        
        }

        #form {
        border: 1px solid black;
        border-radius: 5px;
        
        }
        .container{
            border-radius: 5px;
        }
</style>
<div class="container p-2 bg-white">
    <div class="cad_lab">
        <h4>Agendar reserva de laboratório</h4>
        <form action="" class="p-4" id="form">
            <div class="row">
                <div class="cell-6 p-2">
                    <div class="" >
                        <label >Selecione um professor</label>
                        <select name="professor" id="professor">
                            <option value=""></option>
                            <?php
                                $lista = $mysqli->query("SELECT * FROM cad_professores  ORDER BY nome");
                                $ordem = 1;  
                                while($dados = $lista->fetchArray()){
                                    $id = $dados['id'];
                                    $nome = $dados['nome'];
                                    ?>
                                    <option value="<?php echo $id ?>"><?php echo $nome ?></option>
                                    <?php

                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="cell-6 p-2">
                    <div class="" >
                        <label >Selecione um laboratório</label>
                        <select name="laboratorio" id="laboratorio">
                            <option value=""></option>
                            <?php
                                $lista = $mysqli->query("SELECT * FROM cad_laboratorio  ORDER BY nome");
                                $ordem = 1;  
                                while($dados = $lista->fetchArray()){
                                    $id = $dados['id'];
                                    $nome = $dados['nome'];
                                    ?>
                                    <option value="<?php echo $id ?>"><?php echo $nome ?></option>
                                    <?php

                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="cell-8 p-2">
                    <div class="">
                        <label >Descreva o motivo da reserva da sala:</label>
                        <input type="text" id="motivo"  >
                    </div>
                </div>
                <div class="cell-4 p-2">
                    <div class="">
                        <label >Selecione uma data</label>
                        <input type="text" id="datepicker" >
                    </div>
                </div>
                <div class="cell-12 p-2">
                    <div class="ver_horarios">
                        
                    </div>
                    <br>
                </div>


            </div>   
            
            
            
                    
        </form>
    </div>
</div>
<br>
<script>
  $( function() {
    $( "#datepicker" ).datepicker(
        {
   dateFormat: 'dd/mm/yy',
   dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
   dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
   dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
   monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
   monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
   nextText: 'Proximo',
   prevText: 'Anterior'
}
    );
    $( "#datepicker" ).change(function(){
        data = $(this).val();
        id_lab = $('#laboratorio').val();
         if(id_lab == ''){
            alert('Selecione um laboratório!')
            $(this).val('')
         }else{

         
                $.ajax({
                    type: 'POST',
                    url: 'agendamento/ver_horario.php',
                    data: {'data':data,'id_lab':id_lab  },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                      $('.ver_horarios').html(data);  

                    }
                })
            }  
        
    })
    $('#laboratorio').change(function(){
        $('#datepicker').val('');
        $('.ver_horarios').html('');  
    })

  } );
  </script>