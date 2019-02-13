<?php

//Iniciando a sessão
session_start();

/*
// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) {

// Usuário não logado! Redireciona para a página de login 
header("Location: login.php"); 
exit; 
} 


//Capturando dados do usuário logado
  $login = $_SESSION["login"];
  $id_usuario = $_SESSION["id_usuario"];
  $nomeuser = $_SESSION["nome_usuario"]; 
  $permissao = $_SESSION["permissao"];
  $batalhaouser = $_SESSION["batalhao"];
  $rpmuser = $_SESSION["rpm"];
  $mpuser = $_SESSION["mp"];
  $emailuser = $_SESSION["email"];
*/
//Conectando-se ao banco de dados através do nosso arquivo de conexão. 
require_once("conexao.php"); 


?>



<?php 
//Recebendo os dados enviados pelo formulário vítima
  $nome = addslashes($_POST['nome']);
  $sexo = addslashes($_POST['sexo']);
  $rg = addslashes($_POST['rg']);
  $cpf = addslashes($_POST['cpf']);
  $situacao = 1;
  $datanascimento = addslashes($_POST['datanascimento']);
  $estado = addslashes($_POST['estado']);
  $cidade = addslashes($_POST['cidade']);
  $escolaridade = addslashes($_POST['escolaridade']);
  $deficiencia = $_REQUEST['deficiencia'];
  $a = implode("|" , $deficiencia);
  $motivorua = $_REQUEST['motivorua'];
  $b = implode("|" , $motivorua);
  $usuario = addslashes($_POST['usuario']);
  $tipousuario = addslashes($_POST['tipousuario']);
  $situacaorua = addslashes($_POST['situacaorua']);
  $passagem = addslashes($_POST['passagem']);
  $tipopassagem = addslashes($_POST['tipopassagem']);
  $complemento = addslashes($_POST['complemento']);
  $cor = 4;
  
 
//Testando se os valores preenchidos no formulário estão realmente sendo recebidos nas varáveis acima. Teste ok!
 echo $nome.'<br/>';
 echo $sexo.'<br/>';
 echo $rg.'<br/>';
 echo $cpf.'<br/>';
 echo $situacao.'<br/>';
 echo $datanascimento.'<br/>';
 echo $a.'<br/>';
 echo $estado.'<br/>';
 echo $cidade.'<br/>';
 echo $escolaridade.'<br/>';
 echo $situacaorua.'<br/>';
 echo $passagem.'<br/>';
 echo $tipopassagem.'<br/>';
 echo $b.'<br/>';
 echo $usuario.'<br/>';
 echo $tipousuario.'<br/>';
 echo $cor.'<br/>';
 echo $complemento.'<br/>';
 

 exit ();

?>