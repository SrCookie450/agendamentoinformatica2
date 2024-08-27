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
<br>
<div class="container p-2">
<div class="row">
        <div class="cell-6 bg-white m-2">
            <div class="cad_lab">
              <form action="" class="p-4" id="form">
                <h4>Novo cadastro</h4>
                    <div class="" >
                        <label >Nome do professor</label>
                        <input type="text"  class="nome" style="width: 100%;">
                    </div>
                    <input type="submit" class="button alert outline" value="Salvar" >
                    <a href="#" class="button warning outline  cancelar">Cancelar</a>
                </form>
            </div>
        </div>
        <div class="cell-12 bg-white m-2">
        <div class="tabela p-2"></div>
        </div>
        
    </div>
    

</div>

<script>
    $(function(){
        $('.tabela').load('professores/tabela.php');
        $('.cancelar').click(function(e){
            e.preventDefault();
            $('.corpo').load('professores/painel.php');
        })
        $("#form").submit(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            var data = new FormData();
            var nome = $(".nome").val();
           

            data.append("nome", nome);
           

            if(nome == '' ){
                alert("O campo noome não pode ficar vazio!")
            }else{
            
                $.ajax({
                    type: "POST",
                    url: "professores/salva_prof.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        if(response == 1){
                            $(".nome").val('');
                            $('.corpo').load('professores/painel.php');  
                        }else{
                            alert(response)
                        }
                        
                    },
                    error: function(response) {
                        alert("Erro ao salvar dados");
                    }
                });
            }
        });
    })
</script>