<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');

$id = $_POST['id'];
$valor = $_POST['valor'];

$insere = $mysqli->query("UPDATE cad_reserva SET "
. "obs='$valor' "
         
. " WHERE id = '$id'");

?>