<?php
//Iniciando a sessão
session_start();
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

						<h3>Cadastro de Moradores</h3>
						
		<br/>
					 <!--
					 	1 - O formulário abaixo irá enviar os dados para o arquivo cadastro_processa.php através da função action="cadastro_processa.php"
					 	2 - O arquivo cadastro_processa.php irá receber os dados preenchidos em variáveis que estarão relacioanadas as tag "name" de cada campo do formulário.
					 	3 -   --> 			
					  				<form method="POST" action="cad_processa.php">
										<div class="form-group col-xs-12 col-md-12">
											<label> * Nome:</label>
												<input type="text" name="nome" class="form-control" placeholder="Digite o nome..." />
										</div>
										<br/><br/>
										<div class="form-row">
											<div class="form-check-input col-xs-6 col-md-3">
												<label for="sexo"> * Sexo:</label><br/>
													<input type="radio" name="sexo" value="1"> Masculino <br/>
													<input type="radio" name="sexo" value="2"> Feminino 
											</div>
											<div class="form-group col-xs-6 col-md-3">
												<label> RG:</label><br/>
													<input type="text" name="rg" class="form-control"  placeholder="Digite número RG..." />
											</div>
											<div class="form-group col-xs-6 col-md-6">
												<label> * CPF:</label><br/>
													<input type="text" name="cpf" class="form-control"  placeholder="Digite número CPF..." />
											</div>
										</div>
										<br/><br/>
										<div class="form-row">	
											<div class="form-group col-xs-4 col-md-3">
												<label for="datanascimento">Data nascimento:</label><br/>
													<input type="date" name="datanascimento" class="form-control">
											</div>
											<div class="form-group col-xs-4 col-md-3" class="form1">
												<label for="estado"> * Estado:</label><br/>
													<select name="estado" class="form-control" id="estado" >
														<option value="">Escolha o Estado</option>
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
														<option value="">Escolha o Cidade</option>
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
													<input type="radio" name="situacaorua"  value="1"/> Sim <br/>
													<input type="radio" name="situacaorua"  value="2"/> Não 
											</div>
											<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">	
     										</script>
											<script type="text/javascript">
												function habilitarMotivorua(){
												    if(document.getElementById('motivorua').checked == true){
												        document.getElementById('campo').disabled = false;
												    }
												    if(document.getElementById('motivorua').checked == false){
												        document.getElementById('campo').disabled = true;
												       }
												    }
											</script>	
											<div class="form-group col-xs-12 col-sm-6 col-md-9">
												<label for="motivorua"> Motivo que vive na rua:</label><br/>
												<input type="checkbox" name="motivorua[]"  value="Opção de vida"> Opção de vida &nbsp;
												<input type="checkbox" name="motivorua[]"  value="Desacerto familiar"> Desacerto Familiar &nbsp;
												<input type="checkbox" name="motivorua[]"  value="Uso de alcool"> Uso de Alcool &nbsp;
												<input type="checkbox" name="motivorua[]"  value="Uso de drogas"> Uso de Drogas &nbsp;
												<input type="checkbox" name="motivorua[]"  value="Desemprego"> Desemprego &nbsp;<br/>
												<input type="checkbox" name="motivorua[]" id="motivorua" onclick="habilitarMotivorua();" value="6"> Outro &nbsp;&nbsp;
												<input type="text" name="motivorua[]" id="campo" class="form-control" placeholder="Motivo que vive na rua..." disabled>
											</div>	
										</div>	
										<div class="form-row">	
											<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">	
     										</script>
											<script type="text/javascript">
												function habilitarDeficiencia(){
												    if(document.getElementById('deficiencia').checked == true){
												        document.getElementById('campo1').disabled = false;
												    }
												    if(document.getElementById('deficiencia').checked == false){
												        document.getElementById('campo1').disabled = true;
												       }
												    }
											</script>
											<div class="form-check col-xs-4 col-md-3">
												<label for="deficiencia">Possui Deficiência:</label><br/>
													<input type="radio" class="form-check-input" name="deficiencia" id="deficiencia" onclick="habilitarDeficiencia();" value="1"> Sim <br/>
													<input type="radio" class="form-check-input" name="deficiencia" id="deficiencia2" onclick="habilitarDeficiencia();" value="2"> Não 
											</div>
											<div class="form-group col-xs-12 col-md-9">
											<label for="tipodeficiencia"> Tipo de deficiência:</label><br/>	
												<input type="text"  name="tipodeficiencia" class="form-control" id="campo1" placeholder="Tipo de deficiência..." disabled>
											</div>
										</div>
										<div class="form-row">
											<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">	
     										</script>
											<script type="text/javascript">
												function habilitarUsuario(){
												    if(document.getElementById('usuario').checked == true){
												        document.getElementById('tipousuario').disabled = false;
												    }
												    if(document.getElementById('usuario').checked == false){
												        document.getElementById('tipousuario').disabled = true;
												       }
												    }
											</script>
											<div class="form-check col-xs-4 col-md-3">
												<label for="usuario"> Faz uso de Alcool, Drogas:</label><br/>
													<input type="radio" class="form-check-input" name="usuario" id="usuario" onclick="habilitarUsuario();" value="1"> Sim <br/>
													<input type="radio" class="form-check-input" name="usuario" id="usuario2" onclick="habilitarUsuario();" value="2"> Não 
											</div>
											<div class="form-group col-xs-12 col-md-9">
												<label for="tipousuario"> Dependente de:</label><br/>
													<input type="text" name="tipousuario" class="form-control" id="tipousuario" placeholder="Substância que é dependente..." disabled>
											</div>
										</div>
										<br/><br/>
										<div class="form-row">
											<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">	
     										</script>
											<script type="text/javascript">
												function habilitarPassagem(){
												    if(document.getElementById('passagem').checked == true){
												        document.getElementById('tipopassagem').disabled = false;
												    }
												    if(document.getElementById('passagem').checked == false){
												        document.getElementById('tipopassagem').disabled = true;
												       }
												    }
											</script>
											<div class="form-group col-xs-4 col-md-3">
												<label for="passagem"> Passagem Criminal:</label><br/>
													<input type="radio" class="form-check-input" name="passagem" id="passagem" onclick="habilitarPassagem();" value="1"> Sim <br/>
													<input type="radio" class="form-check-input" name="passagem" id="passagem2" onclick="habilitarPassagem();" value="2"> Não 
											</div>
											<div class="form-group col-xs-12 col-md-9" >
												<label for="tipopassagem"> Tipo de Passagem:</label><br/>
													<input type="text" name="tipopassagem" class="form-control" id="tipopassagem" placeholder="Se SIM na opção anterior ..." disabled>
											</div>
										</div>										
										<div class="form-row">										
											<div class="form-group col-xs-12 col-md-12">
											    <label for="complemento">Dados Complementares:</label><br/>
												<textarea name="complemento" class="form-control"  rows="5"></textarea>
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