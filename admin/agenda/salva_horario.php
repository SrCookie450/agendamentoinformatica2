<?php

//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');
	
    
    $horario = $_POST['horarios'];
    $id_lab = $_POST['id_lab'];
    
    $horario = implode(',',$horario);

    $separa = explode(',',$horario);
    $conta = count($separa);
    
    $exclui = $mysqli->query("DELETE FROM cad_horario WHERE  id_lab = '$id_lab' ");


    for($i = 0 ; $i < $conta; $i++){
        $bloco = $separa[$i];
        $separa_bloco = explode('-',$bloco);
        $turno = $separa_bloco[0];
        $dia = $separa_bloco[1];
        $hor = $separa_bloco[2];
        //$valor = $separa_bloco[3];

        $insere = $mysqli->query("INSERT INTO cad_horario ( turno, dia, horario,id_lab)"
        . "VALUES ('$turno' , '$dia','$hor','$id_lab' )");  
    }               
               

     
        echo "1";
        


         

?>