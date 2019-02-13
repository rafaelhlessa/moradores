<?php
require_once('conexao.php');

session_start(); 
//recupera os dados enviados atraves do formulário
//NOME
$nomeArquivo = ($_POST['NmArquivo']);
//NOME TEMPORÁRIO
$file_tmp = $_FILES["file"]["tmp_name"];
 //NOME DO ARQUIVO NO COMPUTADOR
$file_name = $_FILES["file"]["name"];
//TAMANHO DO ARQUIVO
$file_size = $_FILES["file"]["size"];
//MIME DO ARQUIVO
$file_type = $_FILES["file"]["type"];
// ID VÍTIMA
$idVitima = ($_SESSION['id']);
 
if(empty($nomeArquivo)) { //verificando se o campo N° auto está vazio, campo obrigatório

			$_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Atenção!! O campo Nome do Arquivo é de preenchimento obrigatório!</strong>
  										</div>';
			
			header("Location: ver_cadastro.php");

		} else {
 
//lemos o  conteudo do arquivo usando afunção do PHP  file_get_contents
//$binario = file_get_contents($file_tmp);
// evitamos erro de sintaxe do MySQL
$binario = $conn->fetch();

//Verifica a extensão do arquivo
$permitidos = array("jpg" => "image/jpeg");

if (array_search($file_type, $permitidos) === false) {
      
      $_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Extensão do arquivo invalida, verifique se é .PDF ou .JPG!</strong>
  										</div>';
			
			header("Location: ver_cadastro.php");
    
    // Não houveram erros, move o arquivo
    
    } else {

try {
//montamos o SQL para envio dos dados
$sql = $conn->prepare("INSERT INTO u672441645_mor.arquivos (`Codigo` ,`NmArquivo` ,`Descricao` , `Arquivo` ,`Tipo` ,`Tamanho` ,`DtHrEnvio`, `idVitima` ) VALUES ('NULL', :nomeArquivo, :file_name, :binario, :file_type, :file_size, CURRENT_TIMESTAMP,  :idVitima)");
$sql->bindParam( ':nomeArquivo', $nomeArquivo );
$sql->bindParam( ':file_name', $file_name );
$sql->bindParam( ':binario', $binario );
$sql->bindParam( ':file_type', $file_type );
$sql->bindParam( ':idVitima', $idVitima );
$sql->execute();




//Estamos usando a variável global $_SESSION['msg_registro'] para escreve uma mensagem se a inserção dos dados do formulário funcinou ou não e o header para direcionar de volta a pagina do formulário

			$_SESSION['msg_registro'] = '<div class="alert alert-success alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Arquivo registrado com sucesso!</strong>
  										</div>';
			
			header("Location: ver_cadastro.php");

		
	} 

  catch(PDOException $_SESSION) {

			$_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Não foi possível registrar o arquivo!</strong>
  										</div>';
			
			header("Location: ver_cadastro.php");		
	}
}
}
?>