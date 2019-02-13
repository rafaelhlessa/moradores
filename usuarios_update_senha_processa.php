<?php
//Iniciando a sessão
session_start();

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) {

// Usuário não logado! Redireciona para a página de login 
header("Location: login.php"); 
exit; 
} 


//Capturando dados do usuário logado
	$login = $_SESSION["login"];
	$id_usuario = $_SESSION["id_usuario"];
	$nomeuser =	$_SESSION["nome_usuario"]; 
	$permissao = $_SESSION["permissao"];
	$batalhaouser = $_SESSION["batalhao"]; 
	$emailuser = $_SESSION["email"];

//Conectando-se ao banco de dados através do nosso arquivo de conexão. 
include_once("conexao.php"); 


?>



<?php 
//Recebndoa nova senha
$senha = addslashes(trim($_POST['senha']));
$id = addslashes($_POST['id']);

//Criptografando a senha
 $senhasegredo = sha1($senha);

//Verificando se a senha tem menos de 8 digitos
  if(strlen($senha) < 8) {//Verificando se a senha contem menos de 8 caracteres

      $_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Atenção!! A senha deve ter mais de 8 digitos!</strong>
                      </div>';
                      
                      header("Location: usuarios_cadastro.php");

   		           
    } else { //Se a senha estiver dentro das regras, então, alterar senha no bano de dados.

//Alterando os dados dos usuarios
		$sql_edita = "UPDATE u672441645_redec.usuarios SET senha='$senhasegredo', data_cadastro=NOW(), usuario_cadastro='$login' WHERE u672441645_redec.usuarios.id='$id' ";
		
    $result_sql_edita = mysqli_query($conn, $sql_edita);


		if(mysqli_affected_rows($conn) > 0) { //Verificando se a alteração modificou alguma linha

//Estamos usando a variável global $_SESSION['msg_registro'] para escreve uma mensagem se a inserção dos dados do formulário funcinou ou não e o header para direcionar de volta a pagina do formulário

			$_SESSION['msg_registro'] = '<div class="alert alert-success alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Alteração registrada com sucesso!</strong>
  										</div>';
			
			header("Location: usuarios_cadastro.php");
            
		
	} else {

			$_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Atenção!! A alteração não pode ser registrada no banco de dados!</strong>
  										</div>';
			
			header("Location: usuarios_editar.php");
		
	}
exit ();
}

?>