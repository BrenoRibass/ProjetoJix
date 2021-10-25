<?php 
include "./config/conexao.php";

$uploaddir = './vendor/docs/'; //Dir para salvar o arquivo
$uploadfile = $uploaddir . basename($_FILES['arquivo']['name']); //Arquivo
$fileType = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION)); //Extensão do arquivo
$sucesso = 1;
$novoNome = uniqid(rand(), true). "." . $fileType; //Cria um novo nome único



if ($fileType == 'pdf' or $fileType == 'jpg' or $fileType == 'jpeg' or $fileType == 'png' or $fileType == 'docx') //Valida os tipos de arquivo
{
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploaddir.$novoNome)) {// Move o arquivo para o diretorio
   $dados['upado'] = true;
   $aluno = $_POST['nome'];
   $email = $_POST['email'];
   $matricula = $_POST['matricula'];
   $curso = $_POST['curso'];

   $sql_aluno = $sqli -> query("SELECT * FROM alunos WHERE nome = '$aluno' AND matricula = '$matricula'"); //Verifica se o aluno já existe
   $result = $sql_aluno -> num_rows;
   if ( $result > 0) { //Se existir, não cria um novo e usa o existente
       $dados_aluno = $sql_aluno -> fetch_assoc();
       $id_aluno = $dados_aluno['id'];
       $dados['aluno_existente'] = true;


   }else {
    $insert_aluno = $sqli -> query("INSERT INTO alunos(nome, matricula, curso) VALUES('$aluno', '$matricula', '$curso')"); //Se não existir cria um aluno
    $id_aluno = $sqli -> insert_id; //Recupera o id do aluno criado
   }
   $include_doc = $sqli -> query("INSERT INTO documentos (nome,id_aluno) VALUES ('$novoNome','$id_aluno')"); //Salva o nome do documento no banco
   



} else {
    $sucesso = 0;
}



}


if ($sucesso == 1)
$dados['sucesso'] = 1;
$dados['id_aluno'] = $id_aluno;
$dados['arquivo'] = $fileType;
echo json_encode($dados);
