<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');

$nome = $_POST['nome'];

$insere = $mysqli->query("INSERT INTO cad_laboratorio (nome)VALUES ('$nome')");

echo 1;

?>