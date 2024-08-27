<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');
?>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th style="width: 30px;">#</th>
            <th>Nome</th>
                    
            <th><center>Ações</center></th>             
        </tr>
    </thead>
    <tbody>
        <?php
                          
            $lista = $mysqli->query("SELECT * FROM cad_laboratorio  ORDER BY nome");
            $ordem = 1;  
            while($dados = $lista->fetchArray()){
                $id = $dados['id'];
                $nome = $dados['nome'];
                                                                            
                ?>
                <tr>
                    <td><?php echo $ordem ?></td>
                    <td><?php echo $nome ?></td>
                   
                    <td>
                    <center>
                            <button data-id="<?php echo $id ?>" class="button primary cycle small outline editar">
                             <span class="mif-pencil"></span>
                            </button>
                            <button data-id="<?php echo $id ?>" class="button alert cycle small outline excluir">
                             <span class="mif-bin"></span>
                            </button>
                        </center>
                    </td>
                </tr>
                <?php
                            $ordem++;
                          }
                ?>
            </tbody>
        </table>

        <script>
$(function(){
    valor_id='';
    $('.excluir').click(function(e){
        e.preventDefault();
        id=$(this).data('id');
        confirmar=confirm("Deseja realmente excluir este(a) laboratório/sala?");
        if (confirmar==true)
        {
            $.ajax({
            type: 'POST',
            url: 'configuracao/excluir_laboratorio.php',
            data: {'id':id },
                            //se tudo der certo o evento abaixo é disparado
                            success: function(data) {
                                                       
                                if(data==1){
                                    $('.corpo').load('configuracao/laboratorio.php');
                                }else{
                                    alert(data);                   
                                }
                                                
                            }        
                        }) 
        }

    })
    
    $('.editar').click(function(e){
        id=$(this).data('id');
         $.ajax({
                type: 'POST',
                url: 'configuracao/edita_laboratorio.php',
                data: {'id':id },
                //se tudo der certo o evento abaixo é disparado
                success: function(data) {
                    $('#form').html(data); 
                   

                }
            })
    })

             
        
    
})
</script>