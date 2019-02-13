<?php
require_once('conexao.php');

session_start();

//Recuperar o codigo do arquivo atraves do metodo GET
$codigo= $_GET['codigo'];


//Deleta o registro referente a id 
$sql = "DELETE FROM u672441645_mor.arquivos WHERE Codigo= ' ".$codigo." '";

$deleta = $conn->prepare($sql);
$deleta->execute();

$_SESSION['msg_registro'] = '<div class="alert alert-success alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Arquivo deletado com sucesso!</strong>
  										</div>';
			
			header("Location: boletim.php");
?>