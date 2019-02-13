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
//Recebndo os dados enviados pelo formulário usuario edita
		$user = addslashes($_POST['user']);
		$email = addslashes($_POST['email']);
		$nome = addslashes($_POST['nome']);
		$perfil = addslashes($_POST['perfil']);
   		$situacao = addslashes($_POST['situacao']);
   		$batalhao = addslashes($_POST['batalhao1']);
   		$id = addslashes($_POST['id']);

   		$senhasegredo = sha1($senha);
		
 /*
//Testando se os valores preenchidos no formulário estão realmente sendo recebidos nas varáveis acima. Teste ok!
 echo $user.'<br/>';
 echo $batalhao.'<br/>';
 echo $email.'<br/>';
 echo $nome.'<br/>';
 echo $perfil.'<br/>';
 echo $situacao.'<br/>';
 echo $id.'<br/>';
 */
    


//Verificando se o campo login está vazio, este é um campo obrigatório, se estiver vazio enviar usuário para pagina do formulário e solicitar preenchimento.  
if(empty($user)) { //verificando se o campo login está vazio, campo obrigatório

			$_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Atenção!! O campo Login é de preenchimento obrigatório!</strong>
  										</div>';
			
			header("Location: usuarios_cadastro.php");


  		} else if(empty($email)) { //verificando se o campo email está vazio, campo obrigatório

			$_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Atenção!! O campo E-mail é de preenchimento obrigatório!</strong>
  										</div>';

  			header("Location: usuarios_cadastro.php");

   		} else if(empty($nome)) { //verificando se o campo nome está vazio, campo obrigatório

			$_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Atenção!! O campo Nome é de preenchimento obrigatório!</strong>
  										</div>';

  			header("Location: usuarios_cadastro.php");


      } else if(empty($perfil)) { //verificando se o campo perfil está vazio, campo obrigatório

      $_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Atenção!! O campo Perfil é de preenchimento obrigatório!</strong>
                      </div>';

        header("Location: usuarios_cadastro.php");  

      } else if(empty($batalhao)) { //verificando se o campo perfil está vazio, campo obrigatório

      $_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Atenção!! O campo Batalhão é de preenchimento obrigatório!</strong>
                      </div>';

        header("Location: usuarios_cadastro.php"); 

   		           
    } else { //Se os campos anteriores estiverm preenchidos no formulário, então, inserir os dados do formulário no Bando de Dados

//Alterando os dados dos usuarios
		$sql_edita = "UPDATE u672441645_redec.usuarios SET login='$user', email='$email', nome='$nome', bloqueado='$situacao', data_cadastro=NOW(), perfil='$perfil', batalhao='$batalhao', usuario_cadastro='$login' WHERE u672441645_redec.usuarios.id='$id' ";
		
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

}

?>