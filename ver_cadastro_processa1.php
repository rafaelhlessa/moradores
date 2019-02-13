<?php
//Iniciando a sessão
session_start();


//Define id como zero e fazer a Verificação para pegar o id da vítima de verdade na url da pagina
    
    $id = 0;
    
    if(isset($_GET['id']) && empty($_GET['id']) == false) {
      $_SESSION['id'] = addslashes($_GET['id']);
    }  

    $id = $_SESSION['id'];


//Conectando-se ao banco de dados através do nosso arquivo de conexão. 
require_once("conexao.php"); 


?>



<?php 
//Recebendo os dados enviados pelo formulário vítima
    
    $cidade = addslashes($_POST['cidade']);
    $bairro = addslashes($_POST['bairro']);
    $rua = addslashes($_POST['rua']);
    $tempocidade = addslashes($_POST['tempo_cidade']);
    $tempoficar = addslashes($_POST['tempo_ficar']);
    $encaminhamento = addslashes($_POST['aceitou_encaminhamento']);
    $tipoencaminhamento = addslashes($_POST['tipo_encaminhamento']);
    $tipocurso = addslashes($_POST['tipo_curso']);
    $portaobjetos = addslashes($_POST['porta_objetos']);
    $objetos = addslashes($_POST['objetos']);
    $relato = addslashes($_POST['relato']);
    $localabordagem = addslashes($_POST['local_abordagem']);
    $condicaoambiente = addslashes($_POST['condicao_ambiente']);
    $limpezaambiente = addslashes($_POST['limpeza_ambiente']);
    $complemento = addslashes($_POST['complemento']);
    $responsavelabordagem = addslashes($_POST['responsavel_abordagem']);
    $cor = addslashes($_POST['cor']);
    
    

//Testando se os valores preenchidos no formulário estão realmente sendo recebidos nas varáveis acima. Teste ok!
 echo $cidade.'<br/>';
 echo $bairro.'<br/>';
 echo $rua.'<br/>';
 echo $tempocidade.'<br/>';
 echo $tempoficar.'<br/>';
 echo $encaminhamento.'<br/>';
 echo $tipoencaminhamento.'<br/>';
 echo $tipocurso.'<br/>';
 echo $portaobjetos.'<br/>';
 echo $objetos.'<br/>';
 echo $relato.'<br/>';
 echo $localabordagem.'<br/>';
 echo $condicaoambiente.'<br/>';
 echo $limpezaambiente.'<br/>';
 echo $complemento.'<br/>';
 echo $responsavelabordagem.'<br/>';

 

?>