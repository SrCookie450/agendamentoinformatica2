<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');
	
    
$horario = $_POST['horarios'];
$id_lab = $_POST['id_lab'];
$dia_mes = $_POST['dia_mes'];
$dia_semana = $_POST['dia_semana'];
$ano = $_POST['ano'];
$mes = $_POST['mes'];
$usuario = $_POST['usuario'];
$motivo = $_POST['motivo'];


$turno =$_POST['turno'];
$hor = $_POST['horarios'];
$valor = $_POST['valor'];

if($valor == 1){
    $insere = $mysqli->query("INSERT INTO cad_reserva ( turno, horario,dia_mes,id_lab,dia_semana,ano,mes,usuario,motivo)"
    . "VALUES ('$turno' , '$hor','$dia_mes','$id_lab','$dia_semana','$ano','$mes','$usuario','$motivo' )"); 
}else{
    $exclui = $mysqli->query("DELETE FROM cad_reserva WHERE turno='$turno' and horario = '$horario' and dia_mes = '$dia_mes' and mes = '$mes' and id_lab = '$id_lab' and dia_semana = '$dia_semana'");
}

     

  

      echo "1";
 
  

?>