<?php
session_start();

//conectando ao banco de dados
  require_once("conexao.php"); 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>REDE CATARINA - PMSC</title>
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
  <link rel="stylesheet" type="text/css" href="estilos/css/login.css">
  
   

</head>
<body>
<div>
<div class="jumbotron boxlogin">
  <?php
  if(isset($_SESSION['msg_login'])){
        echo $_SESSION['msg_login'];
        unset($_SESSION['msg_login']);
      }
  ?>
        <form method="POST" name="login" id="login" action="login_valida.php">
            <div class="form-group">
              <label>Login:</label>
                <input type="text" name="login" id="login" class="form-control" placeholder="Entre com usuario" />
            </div>
            <div class="form-group">
                <label>Senha:</label>
              <input type="password" name="senha" id="senha" class="form-control" placeholder="Entre com a senha" />
            </div>
            <div class="form-group">
              <label for="funcao">Função:</label><br/>
                <select name="funcao" class="form-control" >
                  <option value="">Selecione o Função</option>
                    <?php
                      $sql_b = "SELECT * FROM u672441645_mor.funcao ";
                        $result_sql_b = $conn->prepare($sql_b);
                          $result_sql_b->execute();
                            while($row_sql_b = $result_sql_b->fetch() ) {
                              echo '<option value="'.$row_sql_b['id'].'">'.$row_sql_b['funcao'].'</option>';
                            }
                    ?>
                </select>
            </div>
            <input type="submit" value="Entrar" class="btn btn-success" />
        </form>
    </div> 
  </div>
<!-- Bootstrap Core JavaScript -->
        <script src="estilos/js/bootstrap.min.js"></script>
</body>
</html>