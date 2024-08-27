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
</style>
<div class="container p-4 bg-white">
<div class="form-group">
    <label>Selecione o nome do laboratório</label>
    <select class="form-control nome_lab">
        <option></option>
        <?php
          $lista = $mysqli->query("SELECT * FROM cad_laboratorio  ORDER BY nome");
          $ordem = 1;  
            while($dados = $lista->fetchArray()){
                $id_laboratorio = $dados['id'];
                $nome = $dados['nome'];
                ?>
            <option value="<?php echo $id_laboratorio ?>"><?php echo $nome ?></option>
                <?php
            }

        ?>
    </select>
</div>

<div class="mostra_horario"></div>
</div>


<script>
    $(function(){
        $('.nome_lab').change(function(){
            id_lab = $(this).val();
            
            $.ajax({
                type: 'POST',
                url: 'agenda/tabela.php',
                data: {'id_lab':id_lab  },
                //se tudo der certo o evento abaixo é disparado
                success: function(data) {
                   
                   $('.mostra_horario').html(data);               
                   

                }
            })
        })
    })
</script>