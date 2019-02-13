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
  $nomeuser = $_SESSION["nome_usuario"]; 
  $permissao = $_SESSION["permissao"];
  $batalhaouser = $_SESSION["batalhao"];
  $rpmuser = $_SESSION["rpm"];
  $mpuser = $_SESSION["mp"];
  $emailuser = $_SESSION["email"];
*/
//Conectando-se ao banco de dados através do nosso arquivo de conexão. 
require_once("conexao.php"); 


?>



<?php 
public function save($params)
    {
        $params_fields = "`".implode("`, `", array_keys($params))."`";
        $params_values = ':'.implode(', :', array_keys($params));

        $query  = "INSERT INTO `{$this->table}`($params_fields) VALUES ($params_values)";
        $stmt   = $this->db->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key",$value);
        }

        $stmt->execute();
        return $query;
    }

    ?>