<?php
session_start();

//conectando ao banco de dados
	require_once("conexao.php"); 


// Recupera o login 
$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE; 
// Recupera a senha, a criptografando em SHA1
$senha = isset($_POST["senha"]) ? sha1(trim($_POST["senha"])) : FALSE; 
// Recupera a função
$funcao = isset($_POST["funcao"]) ? addslashes(trim($_POST["funcao"])) : FALSE;


// Usuário não forneceu a senha ou o login 
if(!$login || !$senha) 
{ 

$_SESSION['msg_login'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Você deve digitar o login e a senha!<br/></strong>
  										</div>';

		header("Location: login.php"); 
exit; 

} 


/** 
* Executa a consulta e validação de login no banco de dados. 
* Apenas um login deve ser retornado, o login deve estar ativo e o batalhão do usuário deve ser igual ao do login informado no formulário 
*/

$sql = "SELECT id, nome, login, senha, email, perfil, sexo, matricula, funcao 
FROM u672441645_mor.usuarios 
WHERE login = '$login' AND bloqueado = 1 AND funcao = '$funcao' LIMIT 1"; 
$conn->beginTransaction();
$result_sql = $conn->prepare( $sql );
$result_sql->execute();
$conn->commit(); 
$total_dados = $result_sql->rowCount();

// Caso o usuário tenha digitado um login válido o número de linhas será 1.. 
if($total_dados) {

// Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão 
$dados = $result_sql->fetch();  


// Agora verifica a senha 
if(!strcmp($senha, $dados["senha"])) { 

// TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário para a pagina inicial 
$_SESSION["id_usuario"] = $dados["id"]; 
$_SESSION["login"] = $dados["login"]; 
$_SESSION["nome_usuario"] = stripslashes($dados["nome"]); 
$_SESSION["permissao"] = $dados["perfil"];
$_SESSION["sexo"] = $dados["sexo"]; 
$_SESSION["email"] = $dados["email"];
$_SESSION["matricula"] = $dados["matricula"];
$_SESSION["funcao"] = $dados["funcao"]; 

header("Location: index.php"); 

exit; 

} else { // Senha inválida

$_SESSION['msg_login'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Senha inválida!<br/></strong>
  										</div>';

		header("Location: login.php");

exit; 
} 
 
 } else { // Login inválido 

$_SESSION['msg_login'] = '<div class="alert alert-danger alert-dismissable">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										<strong>Login inválido!<br/></strong>
  										</div>';

		header("Location: login.php");
exit; 
} 


?>