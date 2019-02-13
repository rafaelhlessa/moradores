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
	$nomeuser =	$_SESSION["nome_usuario"]; 
	$permissao = $_SESSION["permissao"];
	$batalhaouser = $_SESSION["batalhao"]; 
	$emailuser = $_SESSION["email"];

															// PERMISSÃO DE ACESSO PARA CADASTRAR USUARIOS
															 *  SE PERFIL DE ACESSO FOR IGUAL A COMANDANTE OU MINISTERIO PUBLICO OU GUARNIÇÃO. ENTÃO, ACESSO NEGADO! E REDIRECIONA PARA PAGINA INDEX	
															
														
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
*/
//Chamando arquivo de conexão com o banco de dados

require_once('conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
		<head>
			<title>CADASTRO DE MORADORES DE RUA - PMSC</title>

			<meta charset="UTF-8">
			<!-- Tag para fazer site responsivo -->
			<meta name="viewport" content="width=device-width, initial-scale=1" >
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
		    
    <!-- Bootstrap -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js/"></script>
    <!-- Latest compiled and minified CSS -->
    
	<!-- Estilos CSS personalizados dessa pagina -->
		        <link rel="stylesheet" type="text/css" href="estilos/css/index.css">
		        
		</head>
<body>


<div>

<!-- Barra de navegação supereior fixada no topo-->

<nav class="navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Página Principal</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatórios <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Relatório 1</a></li>
            <li><a href="#">Relatório 2</a></li>
            <li><a href="#">Relatório 3</a></li>
          </ul>
        </li>
        <li><a href="cad.php">Cadastro</a></li>
        <li><a href="#">Configurações</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sr. Pontes</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>	
	<br/><br/><br/>
<div class="container">
	<br/>
	<!-- Botão com a função de voltar para pagina inicial -->
			<button type="button" class="btn btn-default"><a href="index.php"><span class="glyphicon glyphicon-circle-arrow-left"></span>  Voltar</a></button>
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
		<p><span class="glyphicon glyphicon-user"></span> Cadastro de Usuários  </p>
	</div>
		<div class="panel-body">
<div>


				<h3>Cadatro de Usuário</h3>

				
<br/><br/>
 <!--
 	1 - O formulário abaixo irá enviar os dados para o arquivo cadastro_processa.php através da função action="cadastro_processa.php"
 	2 - O arquivo cadastro_processa.php irá receber os dados preenchidos em variáveis que estarão relacioanadas as tag "name" de cada campo do formulário.
 	3 -   --> 			
  				<form method="POST" action="usuarios_processa.php">
  					<div class="form-row">
  						<div class="form-group col-xs-6 col-md-4">
								<label>Login:</label><br/>
									<input type="text" name="user" class="form-control" placeholder="Informe o login..." />
							</div>
							<div class="form-group col-xs-6 col-md-4">
								<label>Senha:</label><br/>
									<input type="password" name="senha" class="form-control" placeholder="Informe a senha..." />
							</div>
						</div><br/>
					<div class="form-row">
						<div class="form-group col-xs-6 col-md-6">
							<label>Nome:</label><br/>
								<input type="text" name="nome" class="form-control" placeholder="Informe o nome completo..." />
						</div>
						<div class="form-group col-xs-6 col-md-6">
							<label>Email:</label><br/>
								<input type="email" name="email" class="form-control" placeholder="Informe o e-mail..." />
						</div>
						<div class="form-group col-xs-6 col-md-6">
							<label for="perfil">Perfil:</label><br/>
								<select name="perfil" class="form-control" >
									<option value="">Escolha o Perfil</option>
									<?php
										$sql = "SELECT * FROM u672441645_mor.perfil";
										$result_sql = $conn->prepare($sql);
										$result_sql->execute();
										while($row_sql = $result_sql->fetch() ) {
										echo '<option value="'.$row_sql['id'].'">'.$row_sql['perfil'].'</option>';
														}
											?>
								</select>
						</div>
						<div class="form-group col-xs-6 col-md-4">
							<label for="sexo">Sexo:</label><br/>
								<select name="sexo" class="form-control" >
									<option value="">Escolha o Sexo</option>
									<?php
										$sql = "SELECT * FROM u672441645_mor.sexo";
										$result_sql = $conn->prepare($sql);
										$result_sql->execute();
										while($row_sql = $result_sql->fetch() ) {
										echo '<option value="'.$row_sql['id'].'">'.$row_sql['sexo'].'</option>';
														}
											?>
								</select>
						</div>
						<div class="form-group col-xs-6 col-md-4">
							<label for="matricula">Matricula:</label><br/>
								<input type="text" name="matricula" class="form-control" placeholder="Informe a matricula com dígito..." />
						</div>
						<div class="form-group col-xs-6 col-md-8">
							<label for="funcao">Função:</label><br/>
								<select name="funcao" class="form-control" >
									<option value="">Escolha a Função</option>
									<?php
										$sql = "SELECT * FROM u672441645_mor.funcao";
										$result_sql = $conn->prepare($sql);
										$result_sql->execute();
										while($row_sql = $result_sql->fetch() ) {
										echo '<option value="'.$row_sql['id'].'">'.$row_sql['funcao'].'</option>';
														}
											?>
								</select>
						</div>
					</div>	
						<div class="form-row">
						<div class="form-group col-xs-6 col-md-6">
								<button type="button" class="btn btn-default" ><a href="usuarios_cadastro.php">Limpar</a></button>
								<input type="submit" value="Salvar" class="btn btn-primary" />
						</div>
						</div>		
				</form>

				


									</div>
								</div>
							</div>
			
					
					<div class="panel panel-default">
						<div class="panel-heading">
					  			<p><span class="glyphicon glyphicon-stats"></span> Usuários Cadastrados  </p>
					  	</div>
							<div class="panel-body">

								<table class="table table-hover">
									<thead>
										<tr>
										<th>Login</th>
								        <th>Nome</th>
								        <th>Perfíl</th>
								        <th>Situação</th>
								        <th>Email</th>
								        <th>Função</th>
								        <th>Ação</th>
										</tr>
									</thead>

<?php
/*Mostrar dados dos usuários ativos */


			 		$sql_user = "SELECT
			 							u672441645_mor.usuarios.id,
										u672441645_mor.usuarios.login,
										u672441645_mor.usuarios.nome,
										u672441645_mor.usuarios.email,
										u672441645_mor.usuarios_situacao.situacao,
										u672441645_mor.perfil.perfil,
										u672441645_mor.funcao.funcao
										FROM
											u672441645_mor.usuarios
											INNER JOIN u672441645_mor.perfil ON (u672441645_mor.perfil.id = u672441645_mor.usuarios.perfil)
											INNER JOIN u672441645_mor.usuarios_situacao ON (u672441645_mor.usuarios_situacao.id = u672441645_mor.usuarios.bloqueado)
											INNER JOIN u672441645_mor.funcao ON (u672441645_mor.funcao.id = u672441645_mor.usuarios.funcao)
										ORDER BY
											u672441645_mor.usuarios.bloqueado";

									$result_sql_user = $conn->prepare($sql_user);
									$result_sql_user->execute();
									while($row_sql_user = $result_sql_user->fetch() ) {	
														

								echo '<tbody>';
						    	echo '<tr>';
								echo '<td>'.$row_sql_user['login'].'</td>';
								echo '<td>'.$row_sql_user['nome'].'</td>';
								echo '<td>'.$row_sql_user['perfil'].'</td>';
								echo '<td>'.$row_sql_user['situacao'].'</td>';
								echo '<td>'.$row_sql_user['email'].'</td>';
								echo '<td>'.$row_sql_user['funcao'].'</td>';
								echo '<td><button type="button" class="btn btn-default"><a href="usuarios_editar.php?id='.$row_sql_user['id'].'"><span class="glyphicon glyphicon-pencil"></span>  Alterar</a></button></a></td>';
								echo '</tr>';
								echo '</tbody>';
											
												}
?>												
						</table>
					</div>
				</div>
			</div>		
					
		 <!-- Bootstrap Core JavaScript -->
        <script src="estilos/js/bootstrap.min.js"></script>
</body>
</html>