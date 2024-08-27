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
       
        
        }
</style>
<br>
<div class="container p-2">
<div class="row">
        <div class="cell-6 m-2 bg-white">
            <div class="cad_lab ">
              <form action="" class="p-4" id="form">
                <h4>Novo cadastro</h4>
                    <div class="" >
                        <label >Nome do laboratório</label>
                        <input type="text"  class="nome" style="width: 100%;">
                    </div>
                    <input type="submit" class="button alert outline" value="Salvar" >
                    <a href="#" class="button warning outline  cancelar">Cancelar</a>
                </form>
            </div>
        </div>
        <div class="cell-12 m-2 bg-white">
        <div class="tabela p-2 "></div>
        </div>
        
    </div>
    

</div>

<script>
    $(function(){
        $('.tabela').load('configuracao/tabela.php');
        $('.cancelar').click(function(e){
            e.preventDefault();
            $('.corpo').load('configuracao/laboratorio.php');
        })
        $("#form").submit(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            var data = new FormData();
            var nome = $(".nome").val();
           

            data.append("nome", nome);
           

            if(nome == '' ){
                alert("O campo título não pode ficar vazio!")
            }else{
            
                $.ajax({
                    type: "POST",
                    url: "configuracao/salva_lab.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        if(response == 1){
                            $(".nome").val('');
                            $('.tabela').load('configuracao/tabela.php');  
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