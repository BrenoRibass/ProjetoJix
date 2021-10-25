<?php
include "./config/conexao.php";

//Deleta o documento do aluno e as horas homologadas do mesmo
$id=$_POST['id'];
$arquivo_sql = $sqli -> query("SELECT * FROM documentos WHERE id = '$id'");
$arquivo = $arquivo_sql -> fetch_assoc();
$nome_arquivo = $arquivo['nome'];

if ($nome_arquivo != '') 
unlink("./vendor/docs/$nome_arquivo"); //Deleta o arquivo

$delete = $sqli -> query("DELETE FROM documentos WHERE id = '$id'"); //Deleta no banco



$dados['id'] = $id;
echo $id;


?>