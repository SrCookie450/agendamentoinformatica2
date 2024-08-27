<br>
<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');

?>

<style>
    .container2{
            border-radius: 5px;
            margin-left: 10px;
            margin-right: 10px;
        }
    input[type=text], select,input[type=number] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        
        }
</style>
<div class="container2  p-4 bg-white">
        <h4>Relatório de agendamentos</h4><hr>
        <div class="row">
        <div class="cell-5 p-2">
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
                <div class="cell-2 p-2">
                    <br>
                    <center><h4>Ou</h4></center>
                </div>
                <div class="cell-5 p-2">
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
                <div class="cell-12 p-2">
                    <div id="mostra_rel"></div>

                </div>
        </div>
</div>
<br>
<script>
    $(function(){
        $('#professor').change(function(){
            id = $(this).val();
            $.ajax({
                    type: 'POST',
                    url: 'relatorios/tabela_prof.php',
                    data: {'id':id  },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                      $('#mostra_rel').html(data);  

                    }
                })
        })

        $('#laboratorio').change(function(){
            id = $(this).val();
            $.ajax({
                    type: 'POST',
                    url: 'relatorios/tabela_lab.php',
                    data: {'id':id  },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                      $('#mostra_rel').html(data);  

                    }
                })
        })
    })
</script>