<?php
//cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');
$id = $_POST['id'];
$exclui = $mysqli->query("DELETE FROM cad_professores WHERE id='$id'");

echo "1";
                        