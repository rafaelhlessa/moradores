<?php
//Iniciando a sessão
session_start();

require_once("conexao.php");

$id = 0;
    
    if(isset($_GET['id']) && empty($_GET['id']) == false) {
      $_SESSION['id'] = addslashes($_GET['id']);
    }  

    $id = $_SESSION['id'];

try {
        $sql = "INSERT INTO u672441645_mor.abordagem (id_morador, data_abordagem, cidade, bairro, rua, tempo_cidade, tempo_ficar, aceitou_encaminhamento, tipo_encaminhamento, tipo_curso, porta_objetos, objetos, relato, local_abordagem, condicao_ambiente, limpeza_ambiente, complemento, responsavel_abordagem) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; //email, senha, chave, pergunta
        
        $stm = $conn->prepare($sql);
        $stm->bindParam(1, $_SESSION['id']);
        $stm->bindParam(2, $_POST['cidade']);
        $stm->bindParam(3, $_POST['bairro']);
        $stm->bindParam(4, $_POST['rua']);
        $stm->bindParam(5, $_POST['tempo_cidade']); //@new select box
        $stm->bindParam(6, $_POST['tempo_ficar']);
        $stm->bindParam(7, $_POST['aceitou_encaminhamento']);
        $stm->bindParam(8, $_POST['tipo_encaminhamento']);
        $stm->bindParam(9, $_POST['tipo_curso']);
        $stm->bindParam(10, $_POST['porta_objetos']);
        $stm->bindParam(11, $_POST['objetos']);
        $stm->bindParam(12, $_POST['relato']);
        $stm->bindParam(13, $_POST['local_abordagem']);
        $stm->bindParam(14, $_POST['condicao_ambiente']);
        $stm->bindParam(15, $_POST['limpeza_ambiente']);
        $stm->bindParam(16, $_POST['complemento']);
        $stm->bindParam(17, $_POST['responsavel_abordagem']);


        $stm->execute();

        var_dump($stm);

        $sql_altera_cor = $conn->prepare("UPDATE u672441645_mor.abordagem SET cor=:cor WHERE u672441645_mor.abordagem.id_morador =$id");

        $sql_altera_cor->bindParam( ':cor', $cor );
        $sql_altera_cor->execute();


        $_SESSION['msg_registro'] = '<div class="alert alert-success alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Visita registrada com sucesso!</strong>
                      </div>';
      
        header("Location: ver_cadastro.php?id=$id");
    
  } catch(PDOException $_SESSION) {

      $_SESSION['msg_registro'] = '<div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Não foi possível cadastrar no banco de dados!</strong>
                      </div>';
      
      header("Location: ver_cadastro.php?id=$id");
      exit();
}

?>

