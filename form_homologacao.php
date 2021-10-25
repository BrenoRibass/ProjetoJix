<?php 
include "./config/conexao.php";

//Form que recebe as horas para homologação do documento

$id = $_POST['id']; 
$pesquisa = $_POST['pesquisa'];
$ensino = $_POST['ensino'];
$extensao = $_POST['extensao'];

$update = $sqli -> query("UPDATE documentos SET pesquisa = '$pesquisa', ensino = '$ensino', extensao = '$extensao', homologado ='1' WHERE id = '$id'"); //Atualiza no banco

$dados['sucesso'] = 1;
$dados['id_aluno'] = 1;
echo json_encode($dados);

?>