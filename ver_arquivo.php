<?php
require_once('conexao.php');
 
//recuperar o codigo do arquivo atraves do metodo GET
$codigo= $_GET['codigo'];
 
$consulta = "SELECT a.Arquivo,
					a.Tipo 
					
					FROM u672441645_mor.arquivos a 
					WHERE Codigo= ' ".$codigo." ' ";

$resultado = $conn->prepare($consulta);
$resultado->execute(); 
while ($dados = $resultado->fetch() ) {
$result[] = array(
'tipo' = $dados['Tipo'],
'Arquivo' = $dados['Arquivo'],
);
}
 
   //EXIBE ARQUIVO  - se o navegador não oferecer suporte para a extensão sera solicita dowload do arquivo
   header("Content-type: ".$result."");
   echo (json_encode($result));
 
?>