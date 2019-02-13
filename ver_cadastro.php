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

<br/>

<?php
//A variável global abaixo irá exiibir a mensagem se a inserção dos dados dos formulários funcionou, ou se algum campo obrigatório não foi preenchido.
	if(isset($_SESSION['msg_registro'])) {
		echo $_SESSION['msg_registro'];
		unset($_SESSION['msg_registro']);
	}

	?>

<br/>

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
				<li class="active">
					<a href="#cadastro" data-toggle="tab">Dados Morador</a>
				</li>
				<li>
					<a href="#documentos" data-toggle="tab">Fotos</a>
				</li>
			</ul>
			<div class="tab-content">

				<div id="cadastro" class="tab-pane active in fade">
					<div>
<?php



//Seleciona os dados do cadastrado pelo seu ID que acabamos de pegar na url desta pagina

		$sql = "SELECT
						c.id,
						c.nome,
						c.rg,
						c.cpf,
						DATE_FORMAT(c.data_nascimento, '%d/%m/%Y') as datanascimento,
						c.escolaridade,
						e.escolaridade,
						c.cidade,
						d.id AS idd,
						d.deficiente,
						c.deficiencia,
						c.tipo_deficiencia,
						c.motivo,
						c.usuario,
						u.usuario,
						u.id  AS idu,
						c.tipo_usuario,
						c.situacao_rua,
						s.situacao_rua,
						s.id AS ids,
						c.passagem,
						p.passagem,
						p.id AS idp,
						c.tipo_passagem,
						c.complemento,	
						ci.cidade,
						c.estado,
						es.estado
												
						FROM
						
						u672441645_mor.cadastro c
						
						LEFT JOIN u672441645_mor.cidade ci ON (c.cidade = ci.id)
						LEFT JOIN u672441645_mor.estados es ON (c.estado = es.id)
						LEFT JOIN u672441645_mor.cadastro_escolaridade e ON (c.escolaridade = e.id)
						LEFT JOIN u672441645_mor.deficiencia d ON (c.deficiencia = d.id)
						LEFT JOIN u672441645_mor.usuario u ON (c.usuario = u.id)
						LEFT JOIN u672441645_mor.passagem p ON (c.passagem = p.id)
						LEFT JOIN u672441645_mor.situacao_rua s ON (c.situacao_rua = s.id)

						WHERE
						c.id = '$id'
						GROUP BY
						c.cpf";
								
					$result_sql = $conn->prepare($sql);
					
					$result_sql->execute();

					$rowcount = $result_sql->rowCount();

//Verifica se a consulta retornou mais de uma linha, se sim, mostra o conteúdo do banco, se não, escreve que não encontrou nada utilizando o alert do bootstrap
				if($rowcount > 0){
					while($row_sql = $result_sql->fetch() ) {
						
?>

<br/>
<!-- Vamos criar 3 tabelas para exibir todos os dados cadastrais  -->

	<div>
		<table class="table table-bordered" class="table-striped">
				<thead>
					<tr>
						<th>CPF</th>
						<th>RG</th>
						<th>Nome</th>	
						<th>Data Nascimento</th>
						</tr>
				</thead>

<?php
						echo '<tbody>';
						echo '<tr>';
						echo '<td>'.$row_sql['cpf'].'</td>';
						echo '<td>' .$row_sql['rg'].'</td>';
						echo '<td>' .$row_sql['nome'].'</td>';
						echo '<td>'.$row_sql['datanascimento'].'</td>';
						echo '</tbody>';

					


?>

			</table>
		
		<table class="table table-bordered" class="table-striped">
				<thead>
					<tr>
						<th>Estado de Origem</th>
						<th>Cidade de Origem</th>
						<th>Escolaridade</th>
					</tr>
				</thead>

<?php
						echo '<tbody>';
						echo '<tr>';
						echo '<td>'.$row_sql['estado'].'</td>';
						echo '<td>'.$row_sql['cidade'].'</td>';
						echo '<td>'.$row_sql['escolaridade'].'</td>';
						echo '</tbody>';
?>

				</table>
		
        <table class="table table-bordered" class="table-striped">
				<thead>
					<tr>
						<th>Motivo de viver na Rua</th>
						<th>Faz uso de Alcool e Drogas</th>
						<th>Tipo de Dependência</th>
						<th>Situação de Rua</th>	
						</tr>
				</thead>

<?php
$motivorua = ($row_sql['motivo']);
$row = explode(" | ", $motivorua);

						echo '<tbody>';
						echo '<tr>';
						echo '<td>'.$row_sql['motivo'].'</td>';
						echo '<td>'.$row_sql['usuario'].'</td>';
						echo '<td>'.$row_sql['tipo_usuario'].'</td>';
						echo '<td>'.$row_sql['situacao_rua'].'</td>';
						echo '</tbody>';

?>

			</table>


<table class="table table-bordered" class="table-striped">
				<thead>
					<tr>
						<th>Deficiência</th>
						<th>Tipo de Deficiência</th>
						<th>Passagem Criminal</th>
						<th>Tipo de Passagem</th>	
					</tr>
				</thead>

<?php
						echo '<tbody>';
						echo '<tr>';
						echo '<td>'.$row_sql['deficiente'].'</td>';
						echo '<td>'.$row_sql['tipo_deficiencia'].'</td>';
						echo '<td>'.$row_sql['passagem'].'</td>';
						echo '<td>'.$row_sql['tipo_passagem'].'</td>';
						echo '</tbody>';
?>
		</table>

		
        <table class="table table-bordered" class="table-striped">
				<thead>
					<tr>
						<th>Informações Complementares</th>	
						</tr>
				</thead>

<?php
						echo '<tbody>';
						echo '<tr>';
						echo '<td>'.$row_sql['complemento'].'</td>';
						echo '</tbody>';
						
		echo '</table>';	
						echo '<br/>';	
						//Botão para alterar cadastro
						echo '<button type="button" class="btn btn-default"><a href="cad_editar.php?id='.$row_sql['id'].'"><span class="glyphicon glyphicon-pencil"></span>  Atualizar Cadastro</a></button></a>';

// Faz a SESSION com o id da Vítima e manda para $idVitima para filtrar os documentos da vítima. 			
$_SESSION["id"] = $row_sql['id'];
$id_morador = $row_sql['id'];
?>

			</table>

<br/>
 <!--Botão para alterar
  					<button type="button" class="btn btn-default"><a href="cadastro_editar.php?id=<?php $id ?>"><span class="glyphicon glyphicon-pencil"></span>  Alterar</a></button></a>  -->

<?php
}

} else {
	echo '<div class="alert alert-danger alert-dismissable">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Não encontramos os dados dessa vitima ..</strong></div>';
} 

?>
			

				</div>
			</div>
		</div>





<!-- Criando a tabela de dados dos Documentos -->
				<div id="documentos" class="tab-pane fade">
					<div>
						<div class="panel-body">
							<table class="table table-bordered" class="table-striped">
								<thead>
									<tr>
										<th>Nome</th>
										<th>Perfil</th>
										<th>Tipo</th>
										<th>Visualização</th>
										<th>Deletar</th>
									</tr>
								</thead>
									<?php
										
										
													
														$consulta = "SELECT 
																			f.id AS idFoto,
																			f.foto_nome AS nomeFoto,
																			f.foto_perfil AS perfilFoto,
																			f.foto_tipo AS tipoFoto

																			FROM u672441645_mor.fotos f
																			
																			WHERE
																			f.id_morador = '$id_morador' ";

														$resultado = $conn->prepare($consulta);

														$resultado->execute();
										 
														while($dados = $resultado->fetch()){

													
														$Codigo = $dados['idFoto'];			
														echo '<tbody>';
														echo '<tr>';
														echo '<td>'.$dados['nomeFoto'].'</td>';
														echo '<td>'.$dados['perfilFoto'].'</td>';
														echo '<td>'.$dados['tipoFoto'].'</td>';
														
														echo "<td><a href='abrir_arquivo.php?idFoto=$Codigo' target='_blank'><img src='img/open.png'></a></td>";
														echo "<td><a href='deleta.php?idFoto=$Codigo' img='img/deletar.png' /><img src='img/delete.png'></a></td>";
														echo '</tbody>';
													
										}
											
													
											
									?>

							</table>
							<!-- Fecha a div=panel_body do documento -->
						</div>
						<div class="panel panel-default">
							<div class="panel-body">
								<form action="upload_binario.php" method="post" enctype="multipart/form-data"> 								
									<div class="form-inline">
					  					<div class="form-group" class="form1">
											<label> Descrição:</label><br>
												<input id="descricao_documento" name="perfil" type="text" class="form-control" size="40" maxlength="100" placeholder="Foto de frente, Foto de Perfil..." /> 			
												
										</div></br></br>
										<div class="form-group"><!--1.1-->	
											<label > * Arquivo:</label><br>	
												<input name="arquivo" type="file" class="btn btn-default" size="45"/> 
													
										</div><!--1.1 Fecha-->
										<br/>
										<div>	
											<!--Enviar -->
											<br/>
											<input type="submit" class="btn btn-primary" value="Enviar" /> 
										</div>
									</div>	
								</form>
							</div>
						</div>
					</div>
				</div>				




				
			<!-- fecha div antes do select da vítima -->
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
				<form method="POST" action="ver_cadastro_processa.php">
					<!--Criando uma tag input com campo tipo hidden para enviar o id da linha que está em edição de forma oculta para o nosso arquivos de update -->
  					<input type="hidden" name="id" value="<?php echo $id; ?>"/>
					<div class="form-group">	
						<div class="form-group col-xs-6 col-md-6">
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
							<br/>
						</div>
						<div class="form-group col-xs-6 col-md-6">
							<label for="bairro">Bairro:</label><br/>
								<input type="text" name="bairro" class="form-control" /><br/>
						</div>
						<div class="form-group col-xs-12 col-md-12">
							<label for="rua">Rua:</label><br/>
								<input type="text" name="rua" class="form-control" /><br/>
						</div>
						<div class="form-group col-xs-6 col-md-6">
							<label for="tempo_cidade">Tempo na Cidade:</label><br/>
								<input type="text" name="tempo_cidade" class="form-control" /><br/>
						</div>
						<div class="form-group col-xs-6 col-md-6">
							<label for="tempo_ficar">Quanto tempo pretende ficar:</label><br/>
								<input type="text" name="tempo_ficar" class="form-control" /><br/>
						</div>
					</div>	
					<div class="form-group">	
						<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
							<script type="text/javascript">
								function habilitarEncaminhamento(){
								    if(document.getElementById('aceitou_encaminhamento').checked == true){
								        document.getElementById('tipo_encaminhamento').disabled = false;
								    }
								    if(document.getElementById('aceitou_encaminhamento').checked == false){
									        document.getElementById('tipo_encaminhamento').disabled = true;
							       }
							    }
						</script>
						<div class="form-check col-xs-6 col-md-2">
							<label for="aceitou_encaminhamento">Encaminhamento:</label><br/>
								<input type="radio" class="form-check-input" name="aceitou_encaminhamento" id="aceitou_encaminhamento" onclick="habilitarEncaminhamento();" value="Sim"> Sim <br/>
								<input type="radio" class="form-check-input" name="aceitou_encaminhamento" id="aceitou_encaminhamento2" onclick="habilitarEncaminhamento();" value="Não"> Não 
						</div>
						<div class="form-group col-xs-6 col-md-4" class="styled-select">
							<label for="pa">Tipo de Encaminhamento:</label><br/>
								<select name="tipo_encaminhamento" id="tipo_encaminhamento" class="form-control" disabled >
									<option value="">Escolha o encaminhamento</option>
									<?php
										$sql_at = "SELECT * FROM u672441645_mor.encaminhamento ORDER BY id";
											$result_sql_at = $conn->prepare($sql_at);
												$result_sql_at->execute();
													while($row_sql_at = $result_sql_at->fetch()){
														echo '<option value="'.$row_sql_at['id'].'">'.$row_sql_at['descricao'].'</option>';
									
													}
									?>
								</select>
						</div>		
						<div class="form-group col-xs-6 col-md-6">
							<label for="tipo_curso">Tipo de Curso:</label><br/>
								<input type="text" name="tipo_curso" class="form-control" />
						</div>
					</div>
					<div class="form-group">						
						<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
						<script type="text/javascript">
							function habilitarPertences(){
							    if(document.getElementById('porta_objetos').checked == true){
							        document.getElementById('objetos').disabled = false;
							    }
							    if(document.getElementById('porta_objetos').checked == false){
							        document.getElementById('objetos').disabled = true;
						       }
						    }
						</script>
						<div class="form-group col-xs-6 col-md-2">
							<label for="porta_objetos">Pertences pessoais:</label><br/>
								<input type="radio" class="form-check-input" name="porta_objetos" id="porta_objetos" onclick="habilitarPertences();" value="Sim"> Sim <br/>
								<input type="radio" class="form-check-input" name="porta_objetos" id="porta_objetos2" onclick="habilitarPertences();" value="Não"> Não 
						</div>
						<div class="form-group col-xs-6 col-md-10">
							<label for="objetos"> Descreva os pertences:</label><br/>
								<input type="text" name="objetos" class="form-control" id="objetos" placeholder="Relação de pertences..." disabled/>
						</div>
					</div>		
						<div class="form-group col-xs-12 col-md-12">
								<label for="relato">Relato Entrevistador:</label><br/>
								<textarea name="relato" class="form-control" rows="5" ></textarea><br/><br/>
						</div>
					<div class="form-row">
						<div class="form-group col-xs-12 col-md-12">
							<label for="mensagem">Status do Atendimento:</label><br/>
								<input type="radio" class="form-check-input" name="cor" value="1"/><span style="background-color: #28a745"><font color="white">  Abordado Colaborativo (Abordado pacífico e colaborativo)  </font></span><br/>
                				<input type="radio" class="form-check-input" name="cor" value="2"/><span style="background-color: #dc3545"><font color="white">  Abordado Agressivo (Abordado parece estar sob efeito de drogas) </font></span>
                		</div>
					</div>			
					<div class="form-row">	
						<div class="form-group col-xs-6 col-md-4" class="styled-select">
							<label for="pa">Local onde o abordado se encontra:</label><br/>
								<select name="local_abordagem" class="form-control" >
									<option value="">Escolha o local</option>
									<?php
										$sql_at = "SELECT * FROM u672441645_mor.local ORDER BY id";
											$result_sql_at = $conn->prepare($sql_at);
												$result_sql_at->execute();
													while($row_sql_at = $result_sql_at->fetch()){
														echo '<option value="'.$row_sql_at['id'].'">'.$row_sql_at['local'].'</option>';
									
													}
									?>
								</select>
							</div>
							<div class="form-group col-xs-6 col-md-4">
										<label for="condicao_ambiente"> Condições do ambiente:</label><br/>
											<input type="radio" class="form-check-input" name="condicao_ambiente"  value="1"> Salubre <br/>
											<input type="radio" class="form-check-input" name="condicao_ambiente"  value="2"> Insalubre 
							</div>
							<div class="form-group col-xs-6 col-md-4">
										<label for="limpeza_ambiente"> Foi necessária a limpeza do ambiente:</label><br/>
											<input type="radio" class="form-check-input" name="limpeza_ambiente"  value="Sim"> Sim <br/>
											<input type="radio" class="form-check-input" name="limpeza_ambiente"  value="Não"> Não 
							</div>
					</div>
						<div class="form-group col-xs-12 col-md-12">
								<label for="complemento">Dados Complementares:</label><br/>
								<textarea name="complemento" class="form-control" rows="5" ></textarea>
						</div>
					<div class="form-row" align="center">
							<div class="form-group col-xs-4 col-md-3">
								<button type="button" class="btn btn-default form-control"><a href="ver_cadastro.php">Limpar</a></button>
							</div>
							<div class="form-group col-xs-4 col-md-3">
								<input type="submit" value="Salvar" class="btn btn-primary form-control">
							</div>										
						</div>		
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
					a.id,
					DATE_FORMAT(a.data_abordagem, '%d/%m/%Y') AS datacadastro,
					a.cidade,
					a.bairro,
					a.endereco,
					a.tempo_cidade,
					a.tempo_ficar,
					a.aceitou_encaminhamento,
					a.tipo_encaminhamento AS descricao,
					a.tipo_curso,
					a.porta_objetos,
					a.objetos,
					a.relato,
					a.local_abordagem,
					a.condicao_ambiente,
					a.limpeza_ambiente,
					a.complemento,
					a.responsavel_abordagem,
					a.usuario_registro,
					a.funcao,
					a.matricula,
					ci.id AS idci,
					ci.cidade,
					am.id AS idam,
					am.condicao,
					l.id AS idlo,
					l.local, 
					e.id AS ide,
					e.descricao

					
					
					FROM
					u672441645_mor.abordagem a
					LEFT JOIN u672441645_mor.cidade ci ON (ci.id = a.cidade)
					LEFT JOIN u672441645_mor.ambiente am ON (am.id = a.condicao_ambiente)
					LEFT JOIN u672441645_mor.local l ON (l.id = a.local_abordagem)
					LEFT JOIN u672441645_mor.encaminhamento e ON (e.id = a.tipo_encaminhamento)



			WHERE 
	 			a.id_morador = '$id' AND
	 			(a.relato LIKE '%$pesquisa%' OR
	 			a.cidade LIKE '%$pesquisa%' OR
	 			a.local_abordagem LIKE '%$pesquisa%' OR
	 			a.responsavel_abordagem LIKE '%$pesquisa%' OR
	 			a.endereco LIKE '%$pesquisa')
	 			

	 		ORDER BY a.data_abordagem DESC";
	
		$result_sql_msg = $conn->prepare($sql_msg);
		$result_sql_msg->execute();
		$total = $result_sql_msg->rowCount();

//Verifica se a consulta retornou mais de uma linha, se sim, mostra o conteúdo do banco, se não, escreve que não encontrou nada utilizando o alert do bootstrap
				if($total > 0){
					while($row_sql_msg = $result_sql_msg->fetch() ) {


?>

<div class="visita">
		<div class="panel panel-default">
  			<div class="panel-body"> 
  	
  				<strong>Usuário:</strong> <?php echo $row_sql_msg['usuario_registro'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  				<strong>Função:</strong> <?php echo $row_sql_msg['funcao']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Matricula:</strong> <?php echo $row_sql_msg['matricula']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Data registro:</strong> <?php echo $row_sql_msg['datacadastro']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/> 
				<hr>
				<strong>Cidade:</strong> <?php echo $row_sql_msg['cidade']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Bairro:</strong> <?php echo $row_sql_msg['bairro']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Rua:</strong> <?php echo $row_sql_msg['endereco']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
				<strong>Tempo na cidade:</strong> <?php echo $row_sql_msg['tempo_cidade']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Tempo que pretende ficar na cidade:</strong> <?php echo $row_sql_msg['tempo_ficar']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
				<hr>
				<strong>Aceita encaminhamento:</strong> <?php echo $row_sql_msg['aceitou_encaminhamento']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Tipo de encaminhamento:</strong> <?php echo $row_sql_msg['descricao']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Qual curso:</strong> <?php echo $row_sql_msg['tipo_curso']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
				<strong>Possui pertences:</strong> <?php echo $row_sql_msg['porta_objetos']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Descrição dos pertences:</strong> <?php echo $row_sql_msg['objetos']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
				<strong>Relato entrevistador:</strong> <?php echo $row_sql_msg['relato']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<hr>
				<strong>Local onde se encontra:</strong> <?php echo $row_sql_msg['local']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Condições do ambiente:</strong> <?php echo $row_sql_msg['condicao']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Necessária do ambiente:</strong> <?php echo $row_sql_msg['limpeza_ambiente']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
				<strong>Dados complementares:</strong> <?php echo $row_sql_msg['complemento']; ?><br/>
				<hr>
				<strong>Responsável Abordagem:</strong> <?php echo $row_sql_msg['responsavel_abordagem']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
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