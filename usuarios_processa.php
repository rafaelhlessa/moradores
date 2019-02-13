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
  $nomeuser = $_SESSION["nome_usuario"]; 
  $permissao = $_SESSION["permissao"];
  $funcaouser = $_SESSION["funcao"]; 
  $emailuser = $_SESSION["email"];


//Conectando-se ao banco de dados através do nosso arquivo de conexão. 
require_once("conexao.php"); 


?>



<?php 
//Recebndo os dados enviados pelo formulário vítima
		$user = addslashes($_POST['user']);
		$senha = addslashes(trim($_POST['senha']));
		$email = addslashes($_POST['email']);
		$nome = addslashes($_POST['nome']);
		$perfil = addslashes($_POST['perfil']);
    $sexo = addslashes($_POST['sexo']);
    $matricula = addslashes($_POST['matricula']);
    $funcao = addslashes($_POST['funcao']);
    $situacaousuario = 1;
    $senhasegredo = sha1($senha);
		




/*Testando se os valores preenchidos no formulário estão realmente sendo recebidos nas varáveis acima. Teste ok!
 echo $login.'<br/>';
 echo $senha.'<br/>';
 echo $email.'<br/>';
 echo $nome.'<br/>';
 echo $perfil.'<br/>';
 echo $situacaousuario.'<br/>';

 */
  
//buscando os logins existentes no banco para validar e verificar se o administrador está cadastrando logins duplicados. 
$sql = "SELECT login 
FROM u672441645_mor.usuarios WHERE login = '$user'"; 
$result_sql = $conn->prepare($sql);
$result_sql->execute();
$total_dados = $result_sql->rowCount();   

//Verificando se o campo login está vazio, este é um campo obrigatório, se estiver vazio enviar usuário para pagina do formulário e solicitar preenchimento.  
if(empty($user)) { //verificando se o campo login está vazio, campo obrigatório

			$_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Atenção!! O campo Login é de preenchimento obrigatório!</strong>
  										</div>';
			
			header("Location: usuarios_cadastro.php");

    } else if($total_dados > 0) { //verificando se o campo login já está sendo usado

      $_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Atenção!! O Login informado já existe!</strong>
                      </div>';
      
      header("Location: usuarios_cadastro.php");  

		} else if(strlen($senha) < 8) {//Verificando se a senha contem menos de 8 caracteres

      $_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Atenção!! A senha deve ter mais de 8 digitos!</strong>
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

      } else if(empty($funcao)) { //verificando se o campo perfil está vazio, campo obrigatório

      $_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Atenção!! O campo Batalhão é de preenchimento obrigatório!</strong>
                      </div>';

        header("Location: usuarios_cadastro.php"); 

   		           
    } else { //Se os campos anteriores estiverm preenchidos no formulário, então, inserir os dados do formulário no Bando de Dados

//Inserindo os dados selecionados no formulário, e a data-time do cadastro no banco de dados
		$sql_inserir = "INSERT INTO u672441645_mor.usuarios (login, senha, email, nome, bloqueado, data_cadastro, perfil, usuario_cadastro, sexo, matricula, funcao) VALUES (:user, :senhasegredo, :email, :nome, :situacaousuario', NOW(), :perfil', :login, :sexo, :matricula, :funcao)";

    $sql_inserir->bindParam( ':login', $login );
    $sql_inserir->bindParam( ':senha', $senha );
    $sql_inserir->bindParam( ':email', $email );
    $sql_inserir->bindParam( ':nome', $nome );
    $sql_inserir->bindParam( ':bloqueado', $bloqueado );
    $sql_inserir->bindParam( ':nome', $nome );
    $sql_inserir->bindParam( ':sexo', $sexo );
    $sql_inserir->bindParam( ':matricula', $matricula );
    $sql_inserir->bindParam( ':funcao', $funcao );
		
    $result_sql_inserir = $conn->prepare($sql_inserir);
    $result_sql_inserir->execute();



		if($result_sql_inserir->rowCount() > 0) {

//Estamos usando a variável global $_SESSION['msg_registro'] para escreve uma mensagem se a inserção dos dados do formulário funcinou ou não e o header para direcionar de volta a pagina do formulário

			$_SESSION['msg_registro'] = '<div class="alert alert-success alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Cadastro registrado com sucesso!</strong>
  										</div>';
			
			header("Location: usuarios_cadastro.php");

		
	} else {

			$_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Não foi possível cadastrar no banco de dados!</strong>
  										</div>';
			
			header("Location: usuarios_cadastro.php");		
	}
}


?>