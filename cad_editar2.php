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
	$rpmuser = $_SESSION["rpm"];
	$mpuser = $_SESSION["mp"];

														// PERMISSÃO DE ACESSO A ALTERAÇÃO DE CADASTROS	
														//   SE PERFIL DE ACESSO FOR IGUAL A COMANDANTE. ENTÃO, ACESSO NEGADO! E REDIRECIONA PARA PAGINA INDEX	
																												
														$administrador = '1';
														$cartorio = '2';
														$cartoriocap = '3';
														$mp = '4';
														$mpcap = '5';
														$cmtrpm = '6';
														$guarnicao = '7';
														$consulta = '8';

														//if($permissao !== '1' || $permissao !== '3' || $permissao !== '4') 
															if(strcasecmp($permissao, $mp) == 0 || strcasecmp($permissao, $mpcap) == 0 || strcasecmp($permissao, $cmtrpm) == 0 || strcasecmp($permissao, $consulta) == 0) {

															$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
  																				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  																				<strong>Atenção!! Você não tem permissão para alterar cadastros! Contate o administrador..</strong>
  																				</div>';

  															header("Location: index.php");
														}

*/
//Chamando arquivo de conexão com o banco de dados
require_once('conexao.php');


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
	$sql = "SELECT		c.id,
						c.nome,
						c.rg,
						c.cpf,
						c.situacao,
						cs.id AS ids,
						cs.situacao,
						c.data_nascimento,
						c.sexo,
						c.estado,
						c.cidade,
						c.escolaridade,
						e.id AS ide,
						e.escolaridade,
						c.situacao_rua,
						c.motivo,
						c.deficiencia,
						c.tipo_deficiencia,
						c.usuario,
						c.tipo_usuario,
						c.passagem,
						c.tipo_passagem,
						c.complemento,
						c.cidade,
						ci.id as idcid,
						ci.cidade,
						se.id as idn,
						se.sexo,
						c.estado,
						es.id AS idest,
						es.estado
						
						FROM
						u672441645_mor.cadastro c
						LEFT JOIN u672441645_mor.cadastro_situacao cs ON (cs.id = c.situacao)
						LEFT JOIN u672441645_mor.cidade ci ON (c.cidade = ci.id)
						LEFT JOIN u672441645_mor.sexo se ON (se.id = c.sexo)
						LEFT JOIN u672441645_mor.estados es ON (es.id = c.estado)
						LEFT JOIN u672441645_mor.cadastro_escolaridade e ON (e.id = c.escolaridade)
						
						WHERE
						c.id = '$id'
						";

									$result_sql = $conn->prepare( $sql );

									$result_sql->execute();
									$row_sql = $result_sql->fetch(); //lendo os dados 

	

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
		        <link rel="stylesheet" type="text/css" href="estilos/css/cad.css">
		        
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
            <li><a href="relatorio_idade.php">Relatório por idade</a></li>
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
	<br/>
	<!-- div 1 abre o container -->
<div class="container">
	<br/><br/>
<div class="relogio">
<?php
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date("d/m/Y H:i:s");
echo '<div> <span class="glyphicon glyphicon-time"></span> ' .$dataHora.'</div>';
?>
</div>

<br/><br/>

<?php
//A variável global abaixo irá exiibir a mensagem se a inserção dos dados dos formulários funcionou, ou se algum campo obrigatório não foi preenchido.
	if(isset($_SESSION['msg_registro'])) {
		echo $_SESSION['msg_registro'];
		unset($_SESSION['msg_registro']);
	}

	?>
<!-- Painel de exibição do formulário
 -->
<!-- div 2 abre o panel-default --> 
<div class="panel panel-default">
	<div class="panel-heading">
		<p><span class="glyphicon glyphicon-copy"></span> Cadastro de Moradores  </p>
	</div>
		<!-- div 3 abre o panel body -->
		<div class="panel-body">
<!-- div 4 abre -->			
			<div>

		<br/>
		<!-- Painel de exibição do formulário-->
				<div class="panel panel-default">
					<div class="panel-body">

				<h3>Alterar dados cadastrais do morador</h3>
				
<br/>
 <!--
 	1 - O formulário abaixo irá enviar os dados para o arquivo cadastro_update_processa.php --> 			
  				<form method="POST" action="cadastro_update_processa.php">
  					<!--Criando uma tag input com campo tipo hidden para enviar o id da linha que está em edição de forma oculta para o nosso arquivos de update -->
  					<input type="hidden" name="id" value="<?php echo $id; ?>">
  						<div class="form-group col-xs-12 col-md-12">
											<label> * Nome:</label>
												<input type="text" name="nome" class="form-control" value="<?php echo $row_sql['nome']; ?>" />
										</div>
										<br/><br/>
										<div class="form-row">
											<div class="form-group col-xs-6 col-md-3">
												<label for="situacao">Situação:</label><br/>
												<select name="situacao" class="form-control" >
													<?php
													//mostrando o ultimo dado selecionado e salvo no bd dentro da option do campo select 
													echo '<option value="'.$row_sql['ids'].'">'.$row_sql['situacao'].'</option>';
													?>
													<?php
														$sql_status = "SELECT * FROM u672441645_mor.cadastro_situacao ";
															$result_sql_status = $conn->prepare($sql_status);
																$result_sql_status->execute();
																	while($row_sql_status = $result_sql_status->fetch() ) {
																		echo '<option value="'.$row_sql_status['id'].'">'.utf8_encode($row_sql_status['situacao'].'</option>');
																	}
													?>
												</select>
											</div>
											<div class="form-group col-xs-6 col-md-3">
												<label> RG:</label><br/>
													<input type="text" name="rg" class="form-control" value="<?php echo $row_sql['rg']; ?>" />
											</div>
											<div class="form-group col-xs-6 col-md-6">
												<label> * CPF:</label><br/>
													<input type="text" name="cpf" class="form-control" value="<?php echo $row_sql['cpf']; ?>" />
											</div>
										</div>
										<br/><br/>
										<div class="form-row">	
											<div class="form-group col-xs-4 col-md-3">
												<label for="datanascimento">Data nascimento:</label><br/>
													<input type="date" name="datanascimento" class="form-control" value="<?php echo $row_sql['data_nascimento']; ?>">
											</div>
											<div class="form-group col-xs-4 col-md-3" class="form1">
												<label for="estado"> * Estado:</label><br/>
													<select name="estado" class="form-control" id="estado" >
															<?php
																//mostrando o ultimo dado selecionado e salvo no bd dentro da option do campo select 
																echo '<option value="'.$row_sql['idest'].'">'.$row_sql['estado'].'</option>';
															?>
															<?php
															$sql_estado = "SELECT * FROM u672441645_mor.estados ";
																$result_sql_estado = $conn->prepare($sql_estado);
																	$result_sql_estado->execute();
																		while($row_sql_estado = $result_sql_estado->fetch() ) {
																			echo '<option value="'.$row_sql_estado['id'].'">'.$row_sql_estado['estado'].'</option>';
																		}
														?>
													</select>
											</div>
											<div class="form-group col-xs-4 col-md-3">
												<label for="cidade"> * Cidade:</label><br/>
													<select name="cidade" class="form-control" id="cidade" >
															<?php
																//mostrando o ultimo dado selecionado e salvo no bd dentro da option do campo select 
																echo '<option value="'.$row_sql['idcid'].'">'.$row_sql['cidade'].'</option>';
															?>
															<?php
															$sql_cidade = "SELECT * FROM u672441645_mor.cidade ";
																$result_sql_cidade = $conn->prepare($sql_cidade);
																	$result_sql_cidade->execute();
																		while($row_sql_cidade = $result_sql_cidade->fetch() ) {
																			echo '<option value="'.$row_sql_cidade['id'].'">'.$row_sql_cidade['cidade'].'</option>';
																		}
														?>
													</select>
											</div>
											<div class="form-group col-xs-4 col-md-3">
												<label for="escolaridade">Escolaridade:</label><br/>
													<select name="escolaridade" class="form-control" >
														<?php
																//mostrando o ultimo dado selecionado e salvo no bd dentro da option do campo select 
																echo '<option value="'.$row_sql['ide'].'">'.$row_sql['escolaridade'].'</option>';
															?>
														<?php
															$sql_es = "SELECT * FROM u672441645_mor.cadastro_escolaridade ";
																$result_sql_es = $conn->prepare($sql_es);
																	$result_sql_es->execute();
																		while($row_sql_es = $result_sql_es->fetch() ) {
																			echo '<option value="'.$row_sql_es['id'].'">'.$row_sql_es['escolaridade'].'</option>';
																		}
														?>
													</select>
											</div> 					
										</div>
										<br/><br/>
										<div class="form-row">
											<div class="form-check-input col-xs-4 col-md-3">
													<label for="situacaorua">Situação de Rua:</label><br/>
													<?php
													$situacaorua = $row_sql['situacao_rua'];
													?>
													<input type="radio" name="situacaorua"  value= 1  "<?php if ($situacaorua == 1) echo ' checked="checked"'; ?>"/> Sim <br/>
													<input type="radio" name="situacaorua"  value= 2  "<?php if ($situacaorua == 2) echo ' checked="checked"'; ?>"/> Não 
											</div>
											<div class="form-group col-xs-12 col-sm-6 col-md-9">
												<label for="motivorua"> Motivo que vive na rua:</label><br/>
												<?php
												$motivorua = $row_sql['motivo'];
												$row = explode(" | ", $motivorua ); 

												?>
												<input type="checkbox" name="motivorua"  value= "Opção de vida" "<?php 
												for ($i=0;$i<sizeof($row);$i++)
													{if($row[$i] == 'Opção de vida') echo ' checked="checked"'; } ?>"> Opção de vida &nbsp;
												<input type="checkbox" name="motivorua"  value= "Desacerto familiar" "<?php for ($i=0;$i<sizeof($row);$i++)
													{if($row[$i] == 'Desacerto familiar') echo ' checked="checked"'; } ?>"> Desacerto Familiar &nbsp;
												<input type="checkbox" name="motivorua"  value= "Uso de alcool" "<?php for ($i=0;$i<sizeof($row);$i++)
													{if($row[$i] == 'Uso de alcool') echo ' checked="checked"'; } ?>"> Uso de Alcool &nbsp;
												<input type="checkbox" name="motivorua"  value= "Uso de drogas" "<?php for ($i=0;$i<sizeof($row);$i++)
													{if($row[$i] == 'Uso de drogas') echo ' checked="checked"'; } ?>"> Uso de Drogas &nbsp;
												<input type="checkbox" name="motivorua"  value= "Desemprego" "<?php for ($i=0;$i<sizeof($row);$i++)
													{if($row[$i] == 'Desemprego') echo ' checked="checked"'; } ?>"> Desemprego &nbsp;<br/>
												<input type="checkbox" name="motivorua"  value= "Outro" "<?php for ($i=0;$i<sizeof($row);$i++)
													{if($row[$i] == 'Outro') echo ' checked="checked"'; } ?>"> Outro &nbsp;&nbsp;
											</div>	
										</div>	
										<div class="form-row">
											<div class="form-check col-xs-4 col-md-3">
												<label for="deficiencia"> Possui deficiência:</label><br/>
												<?php
												$deficiencia = $row_sql['deficiencia'];
												?>
													<input type="radio" class="form-check-input" name="deficiencia" value= 1 "<?php if ($deficiencia == 1) echo ' checked="checked"'; ?>"> Sim <br/>
													<input type="radio" class="form-check-input" name="deficiencia" value= 2 "<?php if ($deficiencia == 2) echo ' checked="checked"'; ?>"> Não 
											</div>
											<div class="form-group col-xs-12 col-sm-6 col-md-9">
											<label for="tipodeficiencia"> Tipo de deficiência:</label><br/>	
												<input type="text"  name="tipodeficiencia" class="form-control" value="<?php echo $row_sql['tipo_deficiencia']; ?>" >
											</div>
										</div>
										<div class="form-group">
											<div class="form-check col-xs-4 col-md-3">
												<label for="usuario"> Faz uso de Alcool, Drogas:</label><br/>
												<?php
												$usuario = $row_sql['usuario'];
												?>
													<input type="radio" class="form-check-input" name="usuario" value= 1 "<?php if ($usuario == 1) echo ' checked="checked"'; ?>"> Sim <br/>
													<input type="radio" class="form-check-input" name="usuario" value= 2 "<?php if ($usuario == 2) echo ' checked="checked"'; ?>"> Não 
											</div>
											<div class="form-group col-xs-12 col-md-9">
												<label for="tipousuario"> Dependente de:</label><br/>
													<input type="text" name="tipousuario" class="form-control" value="<?php echo $row_sql['tipo_usuario']; ?>">
											</div>
										</div>
										<br/><br/>
										<div class="form-row">
											<div class="form-group col-xs-4 col-md-3">
												<label for="passagem"> Passagem Criminal:</label><br/>
												<?php
												$passagem = $row_sql['passagem'];
												?>
													<input type="radio" class="form-check-input" name="passagem" value= 1 "<?php if ($passagem == 1) echo ' checked="checked"'; ?>"> Sim <br/>
													<input type="radio" class="form-check-input" name="passagem" value= 2 "<?php if ($passagem == 2) echo ' checked="checked"'; ?>"> Não 
											</div>
											<div class="form-group col-xs-12 col-md-9" >
												<label for="tipopassagem"> Tipo de Passagem:</label><br/>
													<input type="text" name="tipopassagem" class="form-control" id="tipopassagem" value="<?php echo $row_sql['tipo_passagem']; ?>">
											</div>
										</div>										
										<div class="form-row">										
											<div class="form-group col-xs-12 col-md-12">
											    <label for="complemento">Dados Complementares:</label><br/>
												<textarea name="complemento" class="form-control"  rows="5" placeholder="Não foram inseridos dados complementares." ><?php echo $row_sql['complemento']; ?></textarea>
											</div>
										</div>
										<br/><br/>
										<div class="form-row">
											<div class="form-group col-xs-4 col-md-3">
													<button type="button" class="btn btn-default form-control"><a href="index.php">Limpar</a></button>
											</div>
											<div class="form-group col-xs-4 col-md-3">
													<input type="submit" value="Salvar" class="btn btn-primary form-control">
											</div>										
										</div>	
									
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


  					