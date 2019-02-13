<!DOCTYPE html>
<html>
<head>
	<title></title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	  <!-- Bootstrap CSS -->
		        <link href="estilos/css/bootstrap.min.css" rel="stylesheet">
		    <!-- Estilos CSS personalizados dessa pagina -->
		        <link rel="stylesheet" type="text/css" href="estilos/css/cadastro.css">
		    <!-- Script  jquery local -->
		        <script src="estilos/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Moradores de Rua</a>
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

<div class="panel panel-default">
	<div class="panel-heading">
		<p><span class="glyphicon glyphicon-copy"></span> Cadastro de Vítimas e Agressores  </p>
	</div>
		<div class="panel-body">
		

<br/>
<!-- Painel de exibição do formulário-->
			<div class="panel panel-default">
					<div class="panel-body">

						<h3>Cadastro de Moradores</h3>
						
						<br/>
						<div class="form-group" class="form1" >
									<label> * Nome:</label>
										<input type="text" name="nome" class="form-control" placeholder="Digite o nome..." />
								</div>
								<div class="form-inline">
									<div class="form-group">
										<label> RG:</label><br/>
											<input type="text" name="rg" class="form-control" placeholder="Digite número RG..." />
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="form-group">
										<label> * CPF:</label><br/>
											<input type="text" name="cpf" class="form-control" placeholder="Digite número CPF..." />
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="form-group" class="form1">
										<label for="datanascimento">Data nascimento:</label><br/>
											<input type="date" name="datanascimento" class="form-control"  />
									</div>
								</div><br/>
								<div class="form-inline">
									
								</div><br/>
								<div class="form-inline">	
									<div class="form-group" class="form1">
										<label for="deficiencia"> * Possui Alguma Deficiência:</label><br/>
										<input type="checkbox" name="deficiencia[]"  value="1"> Não Possui deficiência <br/>
										<input type="checkbox" name="deficiencia[]"  value="2"> Cadeirante <br/>
										<input type="checkbox" name="deficiencia[]"  value="3"> Amputado <br/>
										<input type="checkbox" name="deficiencia[]"  value="4"> Outro <br/>
										<input type="text" name="deficiencia[]" placeholder="Digite qual o tipo de deficiência..." />
									</div><br/><br/>
									<div class="form-group" class="form1" >
										<label> * Cidade e Estado de procedência:</label>
											<input type="text" name="procedencia" class="form-control" placeholder="Ex: Florianópolis/SC..." />
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="form-group" class="form1" >
										<label> * Tempo em Florianópolis:</label>
											<input type="text" name="tempo" class="form-control" placeholder="Ex: 2 Semanas; 5 Meses; 8 Anos ..." />
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<br/><br/>
									<div class="form-group" class="form1">
											<label for="sitrua">Nível de Risco à Vítima:</label><br/>
											<input type="radio" name="sitrua"  value="1"/> Sim <br/>
											<input type="radio" name="sitrua"  value="2"/> Não 
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="form-group" class="form1">
											<label for="passagem">Passagem Criminal:</label><br/>
											<input type="radio" name="passagem"  value="1"/> Sim <br/>
											<input type="radio" name="passagem"  value="2"/> Não 
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="form-group" class="form1" >
										<label> * Tipo de Passagem:</label>
											<input type="text" name="passagemt" class="form-control" placeholder="Se SIM na opção anterior ..." />
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</div>	
			</div>
		</div>
</div>	
</body>
</html>