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

														/* PERMISSÃO DE ACESSO PARA ALTERAR USUARIOS E/OU SENHA
														*  SE PERFIL DE ACESSO FOR IGUAL A COMANDANTE OU MINISTERIO PUBLICO OU GUARNIÇÃO. ENTÃO, ACESSO NEGADO! E REDIRECIONA PARA PAGINA INDEX	
														*/
														
														$administrador = '1';
														$comandante = '2';
														$mp = '3';
														$guarnicao = '4';
														$central = '5';

														
															if(strcasecmp($permissao, $comandante) == 0 || strcasecmp($permissao, $guarnicao) == 0 || strcasecmp($permissao, $mp) == 0 || strcasecmp($permissao, $central) == 0) {

															$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
  																				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  																				<strong>Atenção!! Você não tem permissão para acessar esta área! Contate o administrador..</strong>
  																				</div>';

  															header("Location: index.php");
														}


//Chamando arquivo de conexão com o banco de dados
include_once('conexao.php');


//Define id como zero e fazer a Verificação para pegar o id da linha que está sendo editada no banco de dados. Pegar o id de verdade na url da pagina
		
		$id = 0;
		
		if(isset($_GET['id']) && empty($_GET['id']) == false) {
			$_SESSION['id'] = addslashes($_GET['id']);
		}  

		$id = $_SESSION['id'];

		//Fazendo verificação para evitar que o usuário quebre nossa url, caso ele tente apagar nossas variáveis na url, o mesmo será direcionado para pagina inicial
		if($id < 1) {
			header("Location: index.php");
		}

//Consultando os dados da linha que será editada para popular o formulário de edição com as informações atuais do BD
	$sql_user = "SELECT	u672441645_redec.usuarios.id,
						u672441645_redec.usuarios.login,
						u672441645_redec.usuarios.nome,
						u672441645_redec.usuarios.email,
						u672441645_redec.usuarios_situacao.situacao,
						u672441645_redec.usuarios_situacao.id AS ids,
						u672441645_redec.perfil.perfil,
						u672441645_redec.perfil.id AS idp,
						u672441645_redec.batalhao.id AS idb,
						u672441645_redec.batalhao.batalhao
						FROM
						u672441645_redec.usuarios
						INNER JOIN u672441645_redec.perfil ON (u672441645_redec.perfil.id = u672441645_redec.usuarios.perfil)
						INNER JOIN u672441645_redec.usuarios_situacao ON (u672441645_redec.usuarios_situacao.id = u672441645_redec.usuarios.bloqueado)
						INNER JOIN u672441645_redec.batalhao ON (u672441645_redec.batalhao.id = u672441645_redec.usuarios.batalhao)
						WHERE
						u672441645_redec.usuarios.id = '$id'
						";

									$result_sql_user = mysqli_query($conn, $sql_user);
									$row_sql_user = mysqli_fetch_assoc($result_sql_user); //lendo os dados a atribuindo a variável $row_sql_user
?>


<!DOCTYPE html>
<html lang="pt-br">
		<head>
			<title>RC 1ª RPM - PMSC</title>

			<meta charset="UTF-8">
			<!-- Tag para fazer site responsivo -->
			<meta name="viewport" content="width=device-width, initial-scale=1" >
			
		    <!-- Bootstrap CSS -->
		        <link href="estilos/css/bootstrap.min.css" rel="stylesheet">
		    <!-- Estilos CSS personalizados dessa pagina -->
		        <link rel="stylesheet" type="text/css" href="estilos/css/usuarios.css">
		    <!-- Script  jquery local -->
		        <script src="estilos/js/jquery-3.3.1.min.js"></script> 
		</head>
<body>


<div>
<!-- Barra de navegação supereior fixada no topo-->

	<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
			    <div class="navbar-header">
				      <a class="navbar-brand" href="index.php">Rede Catarina</a>
					    </div>
						    <ul class="nav navbar-nav">
						      	<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
						     		 <li class="dropdown">
						      			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu<span class="caret"></span></a>
						      				<ul class="dropdown-menu">
						         <li><a href="cadastro.php">Cadastro</a></li>
						         <li><a href="registros.php">Registros Inativos</a></li>
						         <li><a href="boletim.php">Boletins de Ocorrência e Mandados</a></li>
						    </ul>
						        </li>
						      	<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatórios<span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="relatorio_acoes_bairro.php">Relatório por batalhão</a></li>
										</ul>
								</li>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">Configurações<span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="usuarios_cadastro.php">Cadastro de usuários</a></li>
										</ul>
								</li>
						    </ul>
						    			<ul class="nav navbar-nav navbar-right">
						     <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> <?php echo $login; ?></a></li>
						   		<li><a href="sair.php"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
				    		</ul>
		  	</div>
		</nav>
</div>	
	<br/><br/><br/>
<div class="container">
	<br/>
<!-- Botão com a função de voltar para pagina inicial -->
			<button type="button" class="btn btn-default"><a href="usuarios_cadastro.php"><span class="glyphicon glyphicon-circle-arrow-left"></span>  Voltar</a></button>
	<br/><br/>
<div class="relogio">
<?php
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date("d/m/Y H:i:s");
echo '<div> <span class="glyphicon glyphicon-time"></span> ' .$dataHora.'</div>';
?>
</div>

<br/><br/><br/>

<?php
//A variável global abaixo irá exiibir a mensagem se a inserção dos dados dos formulários funcionou, ou se algum campo obrigatório não foi preenchido.
	if(isset($_SESSION['msg_registro'])) {
		echo $_SESSION['msg_registro'];
		unset($_SESSION['msg_registro']);
	}

	?>

<!-- Painel de exibição do formulário
 -->

<div class="panel panel-default">
	<div class="panel-heading">
		<p><span class="glyphicon glyphicon-user"></span> Alteração de Usuários  </p>
	</div>
		<div class="panel-body">
<div>

<br/>

<div class="panel panel-default">
	<div class="panel-body">

<br/>
				<h3>Alterar senha do Usuário</h3>
		
<br/><br/>

 <!--
 	1 - O formulário abaixo irá enviar os dados para o arquivo cadastro_processa.php através da função action="cadastro_processa.php"
 	2 - O arquivo cadastro_processa.php irá receber os dados preenchidos em variáveis que estarão relacioanadas as tag "name" de cada campo do formulário.
 	3 -   --> 			
  				<form method="POST" action="usuarios_update_senha_processa.php">
  					<!--Criando uma tag input com campo tipo hidden para enviar o id da linha que está em edição de forma oculta para o nosso arquivos de update -->
  					<input type="hidden" name="id" value="<?php echo $id; ?>">
  					<div class="form-inline">
  						<div class="form-group" class="form1">
								<label>Login:</label>
									<input type="text" name="user" class="form-control"  value="<?php echo $row_sql_user['login']; ?>" />
							</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="form-group" class="form1" >
								<label>Senha:</label>
									<input type="password" name="senha" class="form-control" placeholder="Informe a nova senha..." />
							</div>
					
					<input type="submit" value="Alterar" class="btn btn-primary" />
					</div>
				</form>	
					<br/>
	</div>
</div>

<div class="panel panel-default">
			<div class="panel-body">

<br/>
				<h3>Alterar dados do Usuário</h3>

				
<br/><br/>
 <!--
 	1 - O formulário abaixo irá enviar os dados para o arquivo cadastro_processa.php através da função action="cadastro_processa.php"
 	2 - O arquivo cadastro_processa.php irá receber os dados preenchidos em variáveis que estarão relacioanadas as tag "name" de cada campo do formulário.
 	3 -   --> 			
  				<form method="POST" action="usuarios_update_processa.php">
  					<!--Criando uma tag input com campo tipo hidden para enviar o id da linha que está em edição de forma oculta para o nosso arquivos de update -->
  					<input type="hidden" name="id" value="<?php echo $id; ?>">
  					<div class="form-inline">
  						<div class="form-group" class="form1">
								<label>Login:</label><br/>
									<input type="text" name="user" class="form-control"  value="<?php echo $row_sql_user['login']; ?>" />
							</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="form-group">
							<label>Nome:</label><br/>
								<input type="text" name="nome" class="form-control" value="<?php echo $row_sql_user['nome']; ?>" />
						</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class="form-group">
							<label>Email:</label><br/>
								<input type="email" name="email" class="form-control" value="<?php echo $row_sql_user['email']; ?>" />
						</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</div><br/>			
					<div class="form-inline">
						<div class="form-group">
							<label for="perfil">Perfil:</label><br/>
								<select name="perfil" class="form-control" >
									<?php
									//mostrando o ultimo dado selecionado e salvo no bd dentro da option do campo select 
									echo '<option value="'.$row_sql_user['idp'].'">'.$row_sql_user['perfil'].'</option>';
									?>
									<?php
										$sql = "SELECT * FROM u672441645_redec.perfil";
										$result_sql = mysqli_query($conn, $sql);
										while($row_sql = mysqli_fetch_assoc($result_sql) ) {
										echo '<option value="'.$row_sql['id'].'">'.$row_sql['perfil'].'</option>';
														}
											?>
								</select>
						</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class="form-group">
							<label for="situacao">Situação:</label><br/>
								<select name="situacao" class="form-control" >
									<?php
									//mostrando o ultimo dado selecionado e salvo no bd dentro da option do campo select 
									echo '<option value="'.$row_sql_user['ids'].'">'.$row_sql_user['situacao'].'</option>';
									?>
									<?php
										$sql_situacao = "SELECT * FROM u672441645_redec.usuarios_situacao";
										$result_sql_situacao = mysqli_query($conn, $sql_situacao);
										while($row_sql_situacao = mysqli_fetch_assoc($result_sql_situacao) ) {
										echo '<option value="'.$row_sql_situacao['id'].'">'.$row_sql_situacao['situacao'].'</option>';
														}
											?>
								</select>
						</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div class="form-group">
							<label for="batalhao1">Batalhão:</label><br/>
								<select name="batalhao1" class="form-control" >
									<?php
									//mostrando o ultimo dado selecionado e salvo no bd dentro da option do campo select 
									echo '<option value="'.$row_sql_user['idb'].'">'.$row_sql_user['batalhao'].'</option>';
									?>
									<?php
										$sql = "SELECT * FROM u672441645_redec.batalhao";
										$result_sql = mysqli_query($conn, $sql);
										while($row_sql = mysqli_fetch_assoc($result_sql) ) {
										echo '<option value="'.$row_sql['id'].'">'.$row_sql['batalhao'].'</option>';
														}
											?>
								</select>
						</div>
					</div>	
		<br/><br/>
						
								
								<input type="submit" value="Alterar" class="btn btn-primary" />
				</form>

				


									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		
					
		 <!-- Bootstrap Core JavaScript -->
        <script src="estilos/js/bootstrap.min.js"></script>
</body>
</html>