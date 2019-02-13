<?php
//Iniciando a sessão
session_start();
//Chamando arquivo de conexão com o banco de dados
require_once('conexao.php');
//Define id como zero e fazer a Verificação para pegar o id da vítima de verdade na url da pagina
		
		$id = 0;
		
		if(isset($_GET['id']) && empty($_GET['id']) == false) {
			$_SESSION['id'] = addslashes($_GET['id']);
		}  

		$id = $_SESSION['id'];

		//Fazendo verificação para evitar que o usuário quebre nossa url, caso ele tente apagar nossas variáveis na url, o mesmo será direcionado para pagina inicial
		if($id < 1) {
			header("Location: index.php");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js/"></script>
    <!-- Latest compiled and minified CSS -->
    
	<!-- Estilos CSS personalizados dessa pagina -->
		        <link rel="stylesheet" type="text/css" href="estilos/css/visitas.css">
		        
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
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
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

<br/><br/>

<!-- painel de exibição dos dados da vítima
*No código abaixo criaremos um painel de informações sobre a vítima
*O sistema irá mostrar 2 abas com informações cadastrais da vítima e na outra informações do réu
 -->

<div class="panel panel-default">
	<div class="panel-heading">
  			<p><span class="glyphicon glyphicon-folder-open"></span>  Dados do Cadastrais </p>
  	</div>
		<div class="panel-body">
			<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
		<!-- fecha 2ª div -->
		</div>
	<!-- fecha 1ª div -->
	</div>

<br/><br/>
	
<!-- Formulário para inserir o registros da visita -->

<div class="panel panel-default">
  		<div class="panel-heading">
  			<p><span class="glyphicon glyphicon-comment"></span> Registro de Abordagens</p>
  		</div>
  			<div class="panel-body">
				<form method="POST" action="ver_processa.php">
					<!--Criando uma tag input com campo tipo hidden para enviar o id da linha que está em edição de forma oculta para o nosso arquivos de update -->
  					<input type="hidden" name="id" value="<?php echo $id; ?>">
  						<div class="form-group" class="form1">
							<label for="datatermino">Data Abordagem:</label><br/>
								<input type="date" name="data_abordagem" class="form-control" /><br/>
						</div>
						<div class="form-group" class="form1">
							<label for="datatermino">Cidade:</label><br/>
								<input type="date" name="data_abordagem" class="form-control" /><br/>
						</div>
						<div class="form-group" class="styled-select">
							<label for="pa">Situação:</label><br/>
								<select name="situacao" class="form-control" >
									<option value="">Escolha o usuário</option>
									<?php
												$sql_at = "SELECT 
															*
															 FROM 
															 u672441645_rede.visitas_situacao
															ORDER BY
															 id";

//Verifica se a consulta retornou mais de uma linha, se sim, mostra o conteúdo do banco,
													$result_sql_at = mysqli_query($conn, $sql_at);
														while($row_sql_at = mysqli_fetch_assoc($result_sql_at) ) {
														echo '<option value="'.$row_sql_at['id'].'">'.$row_sql_at['situacao'].'</option>';
									
														}
											?>
								</select>
						</div>
							<div class="form-group" class="form1">
							<label for="datatermino">Data Visita:</label><br/>
								<input type="date" name="data_visita" class="form-control" /><br/>
							</div>
							<div class="form-group">
								<label for="mensagem">Guarnição:</label><br/>
								<input type="text" name="guarnicao" class="form-control" placeholder="Digite a Guarnição..."/><br/>
							</div>
							<div class="form-group">
								<label for="mensagem">Relato Entrevistador:</label><br/>
								<textarea name="mensagem" class="form-control" rows="5" ></textarea><br/><br/>
							</div>
							<div class="form-group">
								<label for="mensagem">Status do Atendimento:</label><br/>
								<input type="radio" name="cor" value="1"/><span style="background-color: #28a745"><font color="white">  Visita a ser apreciada pelo Ministério Público *(Uso da PMSC) </font></span><br/>
                				<input type="radio" name="cor" value="2"/><span style="background-color: #dc3545"><font color="white">  Visita com alteração Vítima em Risco *(Uso da PMSC) </font></span><br/>
                				<input type="radio" name="cor" value="3"/><span style="background-color: #ffc107">  Apreciado pelo Ministério Público *(Uso do MPSC) </span><br/>
								<input type="radio" name="cor" value="5"/><span style="background-color: #819FF7">  Apreciado pelo Judiciário *(Uso do TJSC) </span><br/>
								
							</div> 
								<input type="submit" value="Registrar" class="btn btn-primary" />
				</form>
		</div>
	</div>


<div>
	<br/>
				<div align="center">
					<form class="navbar-form navbar-center" method="POST" action="" >
					  	<div class="input-group">
					   	 	<input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar...">
					    	<div class="input-group-btn">
					     	 	<button class="btn btn-default" type="submit">
					      		  <i class="glyphicon glyphicon-search"></i>
					      		</button>
				   			</div>
				  		</div>
					</form>
				

	<br/>
<?php
//Verifica se o usuário enviou alguma informação pelo formulário, caso sim, armazenar as informações na variável. 
//Recebendo os dados enviados pelo formulário
		$pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : ''; 

//Seleciona as mensagens de relacionamento da tabela ordenando por data de cadastro e id da vítima
	$sql_msg = "SELECT
					v.id,
					v.observacao,
					v.usuario_registro,
					v.guarnicao,
					vs.id AS idvs,
					vs.situacao,
					DATE_FORMAT(v.data_cadastro, '%d/%m/%Y') as datacadastro,
					DATE_FORMAT(v.data_visita, '%d/%m/%Y') as datavisita
					FROM
					u672441645_rede.visitas v
					INNER JOIN u672441645_rede.visitas_situacao vs ON (vs.id = v.situacao)

			WHERE 
	 			v.id_vitima = '$id' AND
	 			(v.observacao LIKE '%$pesquisa%' OR
	 			v.usuario_registro LIKE '%$pesquisa%' OR
	 			vs.situacao LIKE '%$pesquisa%')
	 			

	 		ORDER BY v.data_cadastro DESC";
	
	$result_sql_msg = $conn->prepare($sql_msg);
	$result_sql_msg->execute();
		$total = $result_sql_msg->rowCount();

//Verifica se a consulta retornou mais de uma linha, se sim, mostra o conteúdo do banco, se não, escreve que não encontrou nada utilizando o alert do bootstrap
				if($total > 0){
					while($row_sql_msg = $result_sql_msg->fetch() ) {

switch ($row_sql_msg['idvs']){
    case  1:
      //código se $cor for 1
     {$cor = "verde";}
      break;
    case  3:
      //código se $cor for 3
     {$cor = "laranja";}
      break;
    case 4:
      //código se $cor for 4
    {$cor = "laranja";}
      break;
      case 5:
      //código se $cor for 5
    {$cor = "vermelho";}
      break;
    case 6:
      //código se $cor for 6
    {$cor = "amarelo";}
      break;
     case 7:
      //código se $cor for 6
    {$cor = "azul";}
      break;  
    default:
      //código se $cor não for nenhum dos casos anteriores
    {$cor = "branco";}
      break;
  }
?>

<div class="visita">
		<div class="panel panel-default">
  			<div class="panel-body"> 
  	
  				<strong>Usuário:</strong> <?php echo $row_sql_msg['usuario_registro']; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Status:</strong> 
					<?php 
					echo "<span class='{$cor}'>";
					echo $row_sql_msg['situacao']; 
					echo '</span>'
					?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Data registro:</strong> <?php echo $row_sql_msg['datacadastro']; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				<strong>Data visita:</strong> <?php echo $row_sql_msg['datavisita']; ?> 
				<hr>
				<strong>Guarnição:</strong><br/> <?php echo $row_sql_msg['guarnicao']; ?>
				<hr>
				<strong>Obs. Visita:</strong><br/> <?php echo $row_sql_msg['observacao']; ?>
			</div>
		</div>
</div>

<?php
}

} else {
	echo '<div class="alert alert-warning alert-dismissable">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Não existem registros de visita para esse cadastro...</strong></div>';
	
}

?>

</div><br/><br/>
	</div>			
</div>


<!-- Bootstrap Core JavaScript -->
        <script src="estilos/js/bootstrap.min.js"></script>
</body>
</html>