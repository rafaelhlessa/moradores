<?php
//Criar sessão de pagina logada. Todas as paginas do sistema devem iniciar a o start de sessão de login
session_start();



//Conectando-se ao banco de dados através do nosso arquivo de conexão. 

require_once("conexao.php"); 


//Verificar se está sendo passado na URL a página atual, se não, é atribuido a pagina 
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//Fazendo verificação para evitar que o usuário quebre nossa url, caso ele tente apagar nossas variáveis na url, o mesmo será direcionado para pagina inicial
if(empty($pagina)){
	header("Location: relatorio_registros.php");
} 

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
    <link rel="stylesheet" type="text/css" href="estilos/css/relatorio.css">
	
</head>
<body>
	
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
            <li><a href="relatorio_idade.php">Relatório por Idade</a></li>
            <li><a href="relatorio_escolaridade.php">Relatório por Escolaridade</a></li>
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
</br/>
<div class="container">
</br>

</br>
<div class="relogio">
<?php
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date("d/m/Y h:i:s");
echo '<div>  <font color=white> <span class="glyphicon glyphicon-time"></span> ' .$dataHora.'</div>';
?>
</div>
</br/></br>
<!-- Abaixo formulário de pesquisa por data em um período -->
<div>
	<form name="filtrar" method="GET" class="form-inline">
		
		<div class="form-group">
			<label for="idade">Faixa Etária</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<select name="idade" class="form-control" >
					<option value="">Selecione </option>
						<?php
							$result_intervalo = "SELECT * FROM u672441645_mor.intervalo ORDER BY descricao";
								$resultado_intervalo = $conn->prepare($result_intervalo);
									$resultado_intervalo->execute();
										while($row_intervalo = $resultado_intervalo->fetch() ) {
											echo '<option value="'.$row_intervalo['id'].'">'.$row_intervalo['descricao'].'</option>';
										}									
						?>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		
		
				<input type="submit" value="Pesquisar" class="btn btn-primary"/>
		
	</form>

</div>
<br/>
		<div class="fontecontainer">
		  <div class="panel panel-default" >
		  		<div class="panel-heading">
		  			<p><span class="glyphicon glyphicon-th-list"></span> Registros por Idade</p>
		  		</div>
		  			<div class="panel-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Faixa Etária</th>
									<th>Quantidade de Medidas</th>
								</tr>
							</thead>
<?php			
								//Se o usuário mandar um valor de batalhão, o sistema deve filtrar o pesquisa, se não, mostrar todos os dados
								if(isset($_GET['idade']) && empty($_GET['idade']) == false) {
									$idade = addslashes($_GET['idade']);
									

    									$selecionado = "SELECT 						
																					i.descricao,
    																				c.data_nascimento,
    															 					count(c.id) AS total
																						
																						FROM u672441645_mor.cadastro c 

																						INNER JOIN u672441645_mor.intervalo i 

																						WHERE (DATEDIFF(NOW(), c.data_nascimento) / 365.25) between i.idadeMinima and i.idadeMaxima AND
																						
																						i.id LIKE '%$idade%' 
																						GROUP BY i.descricao"; 
    									
    									$result_sql = $conn->prepare($selecionado);
    									
    									$result_sql->execute();
										
										$rowcount = $result_sql->rowCount();
										
										while($resultado = $result_sql->fetch()) {
    									echo '<tbody>';
										echo '<tr>';
    									echo '<td>'.$resultado['descricao'].'</td>';
    									echo '<td>'.$resultado['total'].'</td>';
										echo '</tr>';
										echo '</tbody>';
										
										}

										} else {

										$idade = isset($_GET['idade']) ? $_GET['idade'] : '';


										$selecionado = "SELECT 						
																					i.descricao,
    																				c.data_nascimento,
    															 					count(c.id) AS total
																						
																						FROM u672441645_mor.cadastro c 

																						INNER JOIN u672441645_mor.intervalo i 

																						WHERE (DATEDIFF(NOW(), c.data_nascimento) / 365.25) between i.idadeMinima and i.idadeMaxima AND
																						
																						i.id LIKE '%$idade%' 
																						GROUP BY i.descricao"; 
    									
    									$result_sql = $conn->prepare($selecionado);
    									
    									$result_sql->execute();
										
										$rowcount = $result_sql->rowCount();
										
										while($resultado = $result_sql->fetch()) {
    									echo '<tbody>';
										echo '<tr>';
    									echo '<td>'.$resultado['descricao'].'</td>';
    									echo '<td>'.$resultado['total'].'</td>';
										echo '</tr>';
										echo '</tbody>';

									}	

								}

								
									
									 
									
?>			
</table>


					</div>
				</div>
			</div>
		</div>
		
<!-- Bootstrap Core JavaScript -->
        <script src="estilos/js/bootstrap.min.js"></script>
  
</body>
</html>
