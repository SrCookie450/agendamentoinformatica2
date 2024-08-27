<br>
<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');
$id_lab = '';
    if(isset($_GET['id_lab'])){
        $id_lab = $_GET['id_lab'];
    }else{
        $id_lab = $_POST['id_lab'];
    }
?>
<style>
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 20px;
  margin-bottom: 5px;
  cursor: pointer;
  font-size: 14px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 15px;
  width: 15px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 5px;
  top: 1px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>

<table class="table striped  table-border row-border cell-border">
           <thead>
               <tr>
                   <th colspan="12">Marque os horários que serão disponibilizados para atendimentos de acordo com os dias e tempos da semana </th>
               </tr>
               <tr>
                   <th>Dias</th>
                   <th colspan="11"><center>Horários</center></th>
               </tr>

           </thead>
           <tbody>
               <?php
                for($d=2;$d<7;$d++){
                    ?>
                    <tr>
                        <td rowspan="4"><center><b><?php echo $d; ?>ª Feira</b></center></td>
                    </tr>
                    <tr>
                        <td>
                            MAT
                        </td>
                        <?php
                        $valor = 1;
                        for($h=1;$h<9;$h++){
                            $n = $h+1;
                            $checado = '';
                            $novo = $valor +1;
                            $horario = $h.'º aula';
                            $lista2 = $mysqli->query("SELECT * FROM cad_horario WHERE dia = '$d' and turno = 'M' and horario = '$horario' and id_lab = '$id_lab'  ");
                            $number_of_rows = 0;//for now

                            while($row = $lista2->fetchArray()) {
                                $number_of_rows += 1;
                            }


                            if($number_of_rows > 0){
                                $checado = 'checked';
                            }

                            ?>
                        <td>
                            <label class="container"><?php echo $horario ?>
                                <input <?php echo $checado ?> name='checks[]' value="<?php echo 'M'.'-'.$d.'-'.$horario?>" type="checkbox" >
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <?php
                        
                        }

                        ?>
                        
                        
                        
                    </tr>
                    <tr>
                        <td>
                            VESP
                        </td>
                        <?php
                        $valor = 1;
                        for($h=1;$h<9;$h++){
                            $n = $h+1;
                            $checado = '';
                            $novo = $valor +1;
                            $horario = $h.'º aula';
                            $lista2 = $mysqli->query("SELECT * FROM cad_horario WHERE  dia = '$d' and turno = 'V' and horario = '$horario' and id_lab = '$id_lab' ");
                            $number_of_rows = 0;//for now

                            while($row = $lista2->fetchArray()) {
                                $number_of_rows += 1;
                            }


                            if($number_of_rows > 0){
                                $checado = 'checked';
                            }
                            ?>
                        <td>
                            <label class="container"><?php echo $horario ?>
                                <input <?php echo $checado ?> name='checks[]' value="<?php echo 'V'.'-'.$d.'-'.$horario?>" type="checkbox" >
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <?php
                          
                        }

                        ?>
                    </tr>
                    <tr>
                        <td>
                            NOT
                        </td>
                        <?php
                        $valor = 1;
                        for($h=1;$h<9;$h++){
                            $n = $h+1;
                            $checado = '';
                            $novo = $valor +1;
                            $horario = $h.'º aula';
                            $lista2 = $mysqli->query("SELECT * FROM cad_horario WHERE   dia = '$d' and turno = 'N' and horario = '$horario' and id_lab = '$id_lab' ");
                            $number_of_rows = 0;//for now

                            while($row = $lista2->fetchArray()) {
                                $number_of_rows += 1;
                            }


                            if($number_of_rows > 0){
                                $checado = 'checked';
                            }
                            ?>
                        <td>
                            <label class="container"><?php echo $h.'º tempo' ?>
                                <input <?php echo $checado ?> name='checks[]' value="<?php echo 'N'.'-'.$d.'-'.$horario?>" type="checkbox" >
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <?php
                            $checado = '';
                            
                        }

                        ?>
                        
                        
                    </tr>
                    <?php
                }
               ?>
               <tr>
                   <th colspan="12">
                       <span class="loder"></span>
                       <button class="button primary salvar" style="width: 100%;">SALVAR</button>
                   </th>
               </tr>
           </tbody>
       </table>

       <script>
           $(function(){
               $('.salvar').click(function(){
                var horarios = new Array();
                id_lab = '<?php echo $id_lab ?>';
                $("input[name='checks[]']:checked").each(function ()
                {
                
                  horarios.push( $(this).val());
                });
              
              
                $.ajax({
                    type: 'POST',
                    url: 'agenda/salva_horario.php',
                    data: {'horarios':horarios,'id_lab':id_lab },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                        $('.loder').html('');
                        $('.salvar').show();
                       if(data == 1){
                           alert('Atualizado com sucesso!');
                           $('.mostra_horario').load('agenda/tabela.php?id_lab='+id_lab);

                       }else{
                         alert(data);
                       }
                                     
                    

                    }
                })
               })
           })
       </script>