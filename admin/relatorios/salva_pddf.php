<br>

 
   
<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');


$id = $_POST['id'];

$lista = $mysqli->query("SELECT * FROM cad_laboratorio  WHERE id = '$id'");
$dados = $lista->fetchArray();
$nome = $dados['nome'];


?>
<style>
    @media print {
            @page {
                size: A4;
            }
        }
    
    .tabela1{
        align: center;
    
    .tabela1 th {
    padding: 5px;
    text-align: center;
}
    .tabela1 td {
    padding: 5px;
    
}
}


</style>
<div class="folha" >
    <h4>Relatório de agendamentos: <?php echo $nome ?></h4>
<table class="tabela1 table " border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
        
        
        <tr>
            <th><center>#</center></th>
            <th>Professor(a)</th>
            <th><center>Data</center></th>
            <th><center>Tempo</center></th>
            <th><center>Turno</center></th>
            <th>Motivo</th>
            <th><center>Obs</center></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ordem = 1;
            $lista = $mysqli->query("SELECT * FROM cad_reserva WHERE  id_lab = '$id' ORDER BY mes, dia_mes,ano ");
            while($dados = $lista->fetchArray()){
                $id_reserva = $dados['id'];
                $id_professor = $dados['usuario'];
                $dia = $dados['dia_mes'];
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

                $lista2 = $mysqli->query("SELECT * FROM cad_professores  WHERE id = '$id_professor'");
                $dados2 = $lista2->fetchArray();
                $nome_lab = $dados2['nome'];
                
                $separa = explode(' ',$horario)

                ?>
                <tr>
                    <td><center><?php echo $ordem ?></center></td>
                    <td><?php echo $nome_lab ?></td>
                    <td><center><?php echo $dia.'/'.$mes ?></center></td>
                    <td><center><?php echo $separa[0] ?></center></td>
                    <td><center><?php echo $turno ?></center></td>
                    <td><?php echo $motivo ?></td>
                    <td><?php echo $obs ?></td>
                </tr>
                <?php

                $ordem++;
            }
        ?>
    </tbody>

</table>
</div>

