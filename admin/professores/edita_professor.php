<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');
$id = $_POST['id'];
$lista = $mysqli->query("SELECT * FROM cad_professores  WHERE id = '$id'");
$dados = $lista->fetchArray();
$nome = $dados['nome'];
?>

<div class="" >
    <h4 class="fg-red">Editar cadastro</h4>
    <label >Nome do professor</label>
    <input type="text"  class="nome" value="<?php echo $nome ?>" style="width: 100%;">
</div>
    <input type="hidden" id="id" value="<?php echo $id ?>">
    <input type="submit" class="button alert outline" id="cadastrar" value="Salvar edição" >
    <a href="#" class="button warning outline  cancelar">Cancelar</a>

<script>
    $(function(){
        $('.cancelar').click(function(e){
            e.preventDefault();
            $('.corpo').load('professores/painel.php');
        })

        $('#cadastrar').click(function(e){
        e.preventDefault();
        nome = $('.nome').val(); 
        id = $('#id').val();       
        if(nome=='' ){
            alert('Digite o nome do(a) professor(a)!');
        }else{

        
        $.ajax({
                type: 'POST',
                url: 'professores/salva_edita_professor.php',
                data: {'nome':nome,'id':id },
                //se tudo der certo o evento abaixo é disparado
                success: function(data) {
                   
                   if(data==1){
                    $('.corpo').load('professores/painel.php');
                   }else{
                    alert(data);
                   }

                }
        })
    }
    })
    })
</script>