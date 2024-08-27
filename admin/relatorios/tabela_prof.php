<br>
<link rel="stylesheet" type="text/css" href="../../js/DataTables/datatables.min.css"/>
 
<script type="text/javascript" src="../../js/DataTables/datatables.min.js"></script>
<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');

$ano_corrente = date('Y');

$id = $_POST['id'];

$lista = $mysqli->query("SELECT * FROM cad_professores  WHERE id = '$id'");
$dados = $lista->fetchArray();
$nome = $dados['nome'];

?>
<hr class="bg-red">
<table class="table striped  table-border row-border cell-border tabel">
    <thead>
        <tr>
            <td colspan="7">Relatório de agendamentos do(a) professor(a): <?php echo $nome.' Ano:  '.$ano_corrente ?></td>
        </tr>
        <tr>
            <td><center>#</center></td>
            <td>Laboratório</td>
            <td><center>Data/tempo</center></td>
            
            <td><center>Turno</center></td>
            <td>Motivo</td>
            <td><center>Obs (digitar na caixa)</center></td>
        </tr>
    </thead>
    <tbody>
        <?php
        $ordem = 1;
            $lista = $mysqli->query("SELECT * FROM cad_reserva WHERE  usuario = '$id' and ano = '$ano_corrente' ORDER BY mes, dia_mes,ano ");
            while($dados = $lista->fetchArray()){
                $id_reserva = $dados['id'];
                $id_laboratorio = $dados['id_lab'];
                $dia = $dados['dia_mes'];
                $ano = $dados['ano'];
                $mes = $dados['mes'];
                if($mes == 1){
                    $mes = 'Jan';
                }elseif($mes == 2){
                    $mes = 'Fev';
                }elseif($mes == 3){
                    $mes = 'Mar';
                }elseif($mes == 4){
                    $mes = 'Abr';
                }elseif($mes == 5){
                    $mes = 'Mai';
                }elseif($mes == 6){
                    $mes = 'Jun';
                }elseif($mes == 7){
                    $mes = 'Jul';
                }elseif($mes == 8){
                    $mes = 'Agos';
                }elseif($mes == 9){
                    $mes = 'Set';
                }elseif($mes == 10){
                    $mes = 'Out';
                }elseif($mes == 11){
                    $mes = 'Nov';
                }elseif($mes == 12){
                    $mes = 'Dez';
                }
                $horario = $dados['horario'];
                $turno = $dados['turno'];
                $motivo = $dados['motivo'];
                $obs = $dados['obs'];

                $lista2 = $mysqli->query("SELECT * FROM cad_laboratorio  WHERE id = '$id_laboratorio'");
                $dados2 = $lista2->fetchArray();
                $nome_lab = $dados2['nome'];
                

                ?>
                <tr>
                    <td><center><?php echo $ordem ?></center></td>
                    <td><?php echo $nome_lab ?></td>
                    <td><center><?php echo $dia.'/'.$mes.'['.$horario.']' ?></center></td>
                    
                    <td><center><?php echo $turno ?></center></td>
                    <td><?php echo $motivo ?></td>
                    <td><input type="text" class="obs" data-id="<?php echo $id_reserva ?>" value="<?php echo $obs ?>"></td>
                </tr>
                <?php

                $ordem++;
            }
        ?>
    </tbody>

</table>
<script>
    $(function(){
        $('.tabel').DataTable({
            language: {
                lengthMenu: 'Total _MENU_ registros por páginas',
                zeroRecords: 'Nothing found - sorry',
                info: 'Mostrando página _PAGE_ de _PAGES_',
                infoEmpty: 'Nenhum registro cadastrado',
                infoFiltered: '(filtered from _MAX_ total records)',
            },
        });
        $('.obs').keyup(function(){
            valor = $(this).val();
            id = $(this).data('id');
            $.ajax({
                    type: 'POST',
                    url: 'relatorios/salva_obs.php',
                    data: {'valor':valor,'id':id  },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                        

                    }
                })
        })
    })
</script>