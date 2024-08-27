<?php

    //cria o banco de dados se ele não existir
$mysqli = new SQLite3('../../db/agenda.db');

	
	
    
   $nome = $_POST['nome'];
   $id = $_POST['id'];

   $insere = $mysqli->query("UPDATE cad_laboratorio SET "
. "nome='$nome' "
         
. " WHERE id = '$id'");
 
   
 
      echo "1";
 
         

?>