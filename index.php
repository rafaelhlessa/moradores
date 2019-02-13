<?php
//Criar sessão de pagina logada
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
	$funcaouser = $_SESSION["funcao"]; 
	$emailuser = $_SESSION["email"];
	$matriculauser = $_SESSION["matricula"];
	$sexouser = $_SESSION["sexo"];
	

	
	

//Conectando-se ao banco de dados.
require_once("conexao.php"); 


//Verificar se está sendo passado na URL a página atual, se não, é atribuido a pagina 
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//Fazendo verificação para evitar que o usuário quebre nossa url, caso ele tente apagar nossas variáveis na url, o mesmo será direcionado para pagina inicial index.php
//Ao mesmo tempo que fazemos a verificação de segurança, também já criamos as variáveis para receber a pesquisa do usuário.
if(empty($pagina)){
	header("Location: index.php");
} 

	
	//Recebendo dados do formulário de busca por vitimas
	$nome = isset($_GET['nome']) ? $_GET['nome'] : null;
	$rg = isset($_GET['rg']) ? $_GET['rg'] : null;
	$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : null;
	$cidade = isset($_GET['cidade']) ? $_GET['cidade'] : null;
	$core = isset($_GET['core']) ? $_GET['core'] : null;

	$sql = "SELECT 
												c.id AS ide,
												c.nome,
												c.rg,
												c.cpf,
												DATE_FORMAT(c.data_nascimento, '%d/%m/%Y') as datanascimento,
												e.escolaridade,
												c.cidade,
												c.situacao,
												c.deficiencia,
												c.motivo,
												c.usuario,
												c.tipo_usuario,
												c.situacao_rua,
												c.passagem,
												c.tipo_passagem,
												c.complemento,
												c.cor,
												a.cor,	
												ci.cidade,
												c.estados
												(select count(a.id) as abordagem from u672441645_mor.abordagem a where a.id_morador = c.id ) as abordagem, a.cor

											FROM 
											u672441645_mor.cadastro c 
											LEFT JOIN u672441645_mor.cor cc ON (c.cor = cc.id)
											LEFT JOIN u672441645_mor.cidade ci ON (c.cidade = ci.id)
											LEFT JOIN 
											LEFT JOIN u672441645_mor.abordagem a ON (c.id = a.id_morador)
											

											WHERE 
											c.situacao = 1 AND
											c.nome LIKE '%$nome%' AND 
											c.rg LIKE '%$rg%'AND
										  	c.cpf LIKE '%$cpf%' AND
										  	c.cidade LIKE '$cidade%' AND
										  	c.cor LIKE '%$core%'
										  	GROUP BY c.nome";

															$result_sql = $conn->prepare( $sql );

															$result_sql->execute();
    


								
//Contar o total de registros
$total_dados = $result_sql->rowCount();
//Contando total de registros para exibir no redapé da página 
$total_registros = $result_sql->rowCount();

//Seta a quantidade de registros por pagina
$quantidade_pg = 20;

//calcular o número de pagina necessárias para apresentar os dados
$num_pagina = ceil($total_dados / $quantidade_pg);

//Calcular o inicio da visualizacao
$inicio = ($quantidade_pg*$pagina)-$quantidade_pg;

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
        <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Configurações<span class="caret"></span></a>
			<ul class="dropdown-menu">
			<li><a href="usuarios_cadastro.php">Cadastro de usuários</a></li>
			</ul>
		</li>
	</ul>		
      <ul class="nav navbar-nav navbar-right">
        	<li><a href="index.php"><span class="glyphicon glyphicon-user"></span><?php echo $login; ?></a></li>
			<li><a href="sair.php"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
      </ul>
    </div>
  </div>
</nav>
</div>	
<br/>
<div class="container">

<br/>

<?php
	if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
	?>

<!-- Formulário de pesquisa -->

<br/>
<div class="relogio">
<?php
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date("d/m/Y H:i:s");
echo '<div> <span class="glyphicon glyphicon-time"></span> ' .$dataHora.'</div>';

?>
</div>

<br/><br/>
<div class="panel panel-default">
  			<div class="panel-body">

<form name="filtrar" method="GET" action="">
	<div class="form-group">	
			<div class="form-group col-md-12">
				<label>Nome: </label>
					<input type="search" name="nome" id="nome" class="form-control" placeholder="Nome da Vitima..." />
						
			</div>
		<div class="form-row">	
			<div class="form-group col-md-3">			
				<label>RG: </label>
					<input type="search" name="rg" id="rg" class="form-control" placeholder="RG da Vitima..." />
						
			</div>
			<div class="form-group col-md-3">
				<label>CPF: </label>
					<input type="search" name="cpf" id="cpf" class="form-control" placeholder="CPF da Vitima..." />
						
			</div>
		
			<div class="form-group col-md-3">		
				<label for="status">Cidade: </label>
						<select name="cidade" class="form-control" id="cidade" >
							<option value="">Escolha o Cidade</option>
								<?php
									$result_cidade = "SELECT * FROM u672441645_mor.cidade ci ORDER BY cidade";
										$resultado_cidade = $conn->prepare($result_cidade);
											$resultado_cidade->execute();
												while($row_cidade = $resultado_cidade->fetch() ) {
													echo '<option value="'.$row_cidade['id'].'">'.$row_cidade['cidade'].'</option>';
												}
								?>
						</select>	
							
			</div>
			<div class="form-group col-md-3">				
				<label for="status">Perfil do Abordado: </label>
							<select name="core" class="form-control" id="core" >
								<option value="">Escolha o Status</option>
									<?php
									$result_perfil = "SELECT * FROM u672441645_mor.abordado_perfil ap ORDER BY perfil";
										$resultado_perfil = $conn->prepare($result_perfil);
											$resultado_perfil->execute();
												while($row_perfil = $resultado_perfil->fetch() ) {
													echo '<option value="'.$row_perfil['id'].'">'.$row_perfil['perfil'].'</option>';
												}
								?>
						</select>							
			</div>
		</div>
			<br/><br/>
			<div class="form-group" align="center">
			 	<input type="submit" value="Pesquisar" class="btn btn-primary botao" />
			</div>			
	</div>
	<br/>
</form>

<!-- Tabela de resultados da pesquisa -->


<table class="table table-hover" class="table-striped">
	<thead>
		<tr>
			<th>Nome</th>
			<th>RG</th>
			<th>CPF</th>
			<th>Cidade</th>
			<th>Abordagens</th>
			<th>Última Visita</th>
		</tr>
	</thead>

<?php
										$sql = "SELECT 
												c.id AS ide,
												c.nome,
												c.rg,
												c.cpf,
												DATE_FORMAT(c.data_nascimento, '%d/%m/%Y') as datanascimento,
												c.cidade,
												ci.cidade,
												c.situacao,
												c.deficiencia,
												c.motivo,
												c.usuario,
												c.tipo_usuario,
												c.situacao_rua,
												c.passagem,
												c.tipo_passagem,
												c.complemento,
												c.cor,
												c.estado,
												a.cor AS core,
												a.data_abordagem AS dAbordagem,
												(select max(a.data_abordagem) AS dAbordagem from u672441645_mor.abordagem a where a.id_morador = c.id group by a.id_morador order by a.data_abordagem desc) as dAbordagem,
												(select count(a.id) as abordagens from u672441645_mor.abordagem a where a.id_morador = c.id) as abordagens
												

											FROM 
											u672441645_mor.cadastro c 
											
											LEFT JOIN u672441645_mor.cidade ci ON (c.cidade = ci.id)
											LEFT JOIN u672441645_mor.abordagem a ON (c.id = a.id_morador)
											

											WHERE 
											c.situacao = 1 AND
											c.nome LIKE '%$nome%' AND 
											c.rg LIKE '%$rg%'AND
										  	c.cpf LIKE '%$cpf%' AND
										  	c.cidade LIKE '$cidade%' AND
										  	c.cor LIKE '%$core%'
										  	GROUP BY c.nome";

															$result_sql = $conn->prepare( $sql );

															$result_sql->execute();

															$total_dados = $result_sql->rowCount();

while($row_sql = $result_sql->fetch() ) {
	if($row_sql > 0) {
		echo '<tbody>';
			switch ($row_sql['core']){
    			case 1:
      				//código se $cor for 1
     				{$cor = "verde";}
      			break;
			    case 2:
			      //código se $cor for 2
			    {$cor = "vermelho";}
			      break;
			    case 3:
			      //código se $cor for 3
			    {$cor = "amarelo";}
			      break;
			    default:
			      //código se $cor não for nenhum dos casos anteriores
			    {$cor = "branco";}
			      break;
			  }
											
				echo "<tr class='{$cor}'>";
				echo '<td>'.$row_sql['nome'].'</td>';
				echo '<td>'.$row_sql['rg'].'</td>';
				echo '<td>'.$row_sql['cpf'].'</td>';
				echo '<td>'.$row_sql['cidade'].'</td>';				
				echo '<td>'.$row_sql['abordagens'].'</td>';
				$pega_data = $row_sql['dAbordagem'];
				$data_sistema = date("Y-m-d");

				$pega_data_Time = new DateTime($pega_data);
				$data_sistema_Time = new DateTime($data_sistema);

				$pega_diferenca = $data_sistema_Time->diff($pega_data_Time);
					if ($pega_diferenca->d <= 7) {
						echo '<td><a href="ver_cadastro.php?id='.$row_sql['ide'].'" class="btn btn-success btn-xs btn-block" role="button">'. $pega_diferenca->d .' dias '.'</a></td>';
					
					} else {
						echo '<td><a href="ver_cadastro.php?id='.$row_sql['ide'].'" class="btn btn-warning btn-xs btn-block" role="button">'. $pega_diferenca->d .' dias '.'</a></td>';
					}
  																								
				echo '<tr>';
				echo '</tbody>';
																					
			}	
		}														
																	
?>
				</table>

					
<?php

//Verificar a pagina anterior e posterior
$pagina_anterior = $pagina - 1;
$pagina_posterior = $pagina + 1;

$pagina1 = 1;

// agora vamos criar os botões "Anterior e próximo"
//$anterior = $pc -1;
//$proximo = $pc +1;
?>
<?php if ($pagina > 1) { ?>
 <a href='index.php?pagina=<?php echo $pagina1; ?>&nome=<?php echo $nome; ?>&n_autos=<?php echo $n_autos; ?>&batalhao=<?php echo $batalhao; ?>&cidade=<?php echo $cidade; ?>&core=<?php echo $core; ?> ' ><span class='glyphicon glyphicon-fast-backward'></span></a> 

<a href='index.php?pagina=<?php echo $pagina_anterior; ?>&nome=<?php echo $nome; ?>&n_autos=<?php echo $n_autos; ?>&batalhao=<?php echo $batalhao; ?>&cidade=<?php echo $cidade; ?>&core=<?php echo $core; ?> ' > <span class='glyphicon glyphicon-chevron-left'></span>Anterior</a> 
<?php }
echo "|";
if ($pagina < $num_pagina) { ?>
<a href='index.php?pagina=<?php echo $pagina_posterior; ?>&nome=<?php echo $nome; ?>&n_autos=<?php echo $n_autos; ?>&batalhao=<?php echo $batalhao; ?>&cidade=<?php echo $cidade; ?>&core=<?php echo $core; ?> ' >Próxima<span class='glyphicon glyphicon-chevron-right'></span> </a>

<a href='index.php?pagina=<?php echo $num_pagina; ?>&nome=<?php echo $nome; ?>&n_autos=<?php echo $n_autos; ?>&batalhao=<?php echo $batalhao; ?>&cidade=<?php echo $cidade; ?>&core=<?php echo $core; ?> '><span class='glyphicon glyphicon-fast-forward'></span></a> 
<?php 
}
echo '<br/> ' .$pagina. ' de ' .$num_pagina. '<br/> Total de registros: ' .$total_registros;


?>						

			</div>
		</div>
	</div>
	 <!-- Bootstrap Core JavaScript -->
        <script src="estilos/js/bootstrap.min.js"></script>

</body>
</html>