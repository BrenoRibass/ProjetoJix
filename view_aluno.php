<?php
include "./config/conexao.php";

//Querys do banco de dados contendo as informações do aluno

$id = $_GET['id']; // Recebe o ID referente ao aluno no banco de dados 
$sql_aluno = $sqli->query("SELECT * FROM alunos WHERE id ='$id' ");
$row_aluno = $sql_aluno->fetch_assoc(); // Recebe os dados do aluno 

$nome_limpo = str_replace(" ", "-", $row_aluno['nome']); //Retira os espaços em branco no nome para o mesmo poder se colocado nas url's de imagem

$sql_horas = $sqli->query("SELECT SUM(pesquisa) as total_pesquisa, SUM(ensino) as total_ensino, SUM(extensao) as total_extensao FROM documentos WHERE id_aluno='$id'");
$row_horas = $sql_horas->fetch_assoc(); //calcula o total de horas de horas do aluno

$horas_pesquisa = $row_horas['total_pesquisa'];  //Total bruto de horas de pesquisa
$horas_ensino = $row_horas['total_ensino'];      //Total bruto de horas de ensino
$horas_extensao = $row_horas['total_extensao'];  //Total bruto de horas de extensao

// Pesquisa = 75 ensino = 45 extensao = 30 de um total de 150

if (intval($horas_pesquisa) > 75) //Verirfica as horas excedentes 
    $excedente_pesquisa = $horas_pesquisa - 75; //Horas validas de pesquisa

if (intval($horas_ensino) > 45)
    $excedente_ensino = $horas_ensino - 45;     //Horas válidas de ensino

if (intval($horas_extensao) > 30)
    $excedente_extensao = $horas_extensao - 30;  //Horas validas de extensao

$total_horas_validas = ($horas_pesquisa - $excedente_pesquisa) + ($horas_ensino - $excedente_ensino) + ($horas_extensao - $excedente_extensao); //Total de horas validas
?>

<!DOCTYPE html>
<html lang="pt-Br" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Documentos - <?php echo $row_aluno['nome']; ?></title>

    <!-- Bulma  -->
    <link rel="stylesheet" href="css/main.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app">
        <section class="hero is-primary is-fullheight has-background-grey-lighter">
            <div class="hero-body">
                <div class="container">


                    <div id='loadApp'>
                        <section class="section is-main-section">
                            <!-- Box com as infos dos alunos -->

                            <div class="box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <img src="https://avatars.dicebear.com/v2/initials/<?php echo $nome_limpo ?>.svg" class="is-rounded" alt="Image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong><?php echo $row_aluno['nome'] . " | Matricula: " . $row_aluno['matricula'] . " | Curso: " . $row_aluno['curso'] ?></strong>
                                                <br>
                                                <Strong> Total de horas: </strong> <?php echo $row_horas['total_pesquisa'] + $row_horas['total_ensino'] + $row_horas['total_extensao'] . " Sendo $total_horas_validas hora(s) válidas"; ?>
                                                <br>
                                                <Strong>Horas de pesquisa: </strong> <?php echo $row_horas['total_pesquisa'];
                                                                                        if (!empty($excedente_pesquisa)) echo " ($excedente_pesquisa hora(s) excedentes)"; ?>
                                                <Strong> | Horas de ensino: </strong> <?php echo $row_horas['total_ensino'];
                                                                                        if (!empty($excedente_ensino)) echo " ($excedente_ensino hora(s) excedentes)"; ?>
                                                <Strong> | Horas de extensão: </strong> <?php echo $row_horas['total_extensao'];
                                                                                        if (!empty($excedente_extensao)) echo " ($excedente_extensao hora(s) excedentes)"; ?>
                                                <br>
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!-- Fim da box-->
                            <div class="card has-table">
                                <header class="card-header">
                                    <p class="card-header-title">
                                        <span class="icon"><i class="mdi mdi-file"></i></span>
                                        Documentos
                                    </p>
                                    <a href="#" class="card-header-icon">
                                        <span class="icon"><i class="mdi mdi-reload"></i></span>
                                    </a>
                                </header>
                                <div class="card-content">
                                    <div class="b-table has-pagination">
                                        <div class="table-wrapper has-mobile-cards">
                                            <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> </th>
                                                        <th>Status</th>
                                                        <th>Data</th>
                                                        <th>Horas p.</th>
                                                        <th>Horas e.</th>
                                                        <th>Horas ext.</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        $sql_documentos = $sqli->query("SELECT * FROM documentos WHERE id_aluno = '$id'  ORDER BY homologado ASC");  //Seleciona os documentos pertencentes ao atual aluno
                                                        while ($row_table = $sql_documentos->fetch_assoc()) { // Lista os documentos na tabela
                                                            $ext = pathinfo($row_table['nome'], PATHINFO_EXTENSION); // Recebe o tipo de arquivo
                                                            $button[intval($row_table['id'])] = "#del_" . $row_table['id'] . ","; //Cria um vetor para ser usado na função ajax pra deletar os documentos, contendo o padrão del_ e depois o id do banco de dados


                                                        ?>

                                                            <td data-label=""><?php echo $row_table['id']; //Data do envio do documento 
                                                                                ?></td>

                                                            <td class="is-image-cell">
                                                                <div class="image">
                                                                    <?php if ($ext == 'pdf') { //Atribui um icone ao tipo de arquivo 
                                                                    ?>

                                                                        <img src="img/pdf.png">

                                                                    <?php } else if ($ext == 'docx') { ?>

                                                                        <img src="img/word.png">

                                                                    <?php } else { ?>

                                                                        <img src="img/img.png">

                                                                    <?php } ?>

                                                                </div>
                                                            </td>
                                                            <td data-label="Comany"><?php if ($row_table['homologado'] == '0') echo "Não homologado";
                                                                                    else echo "<font color='green'> Homologado </font>"; //Status do documento 
                                                                                    ?></td>
                                                            <td data-label=""><?php echo date("d/m/Y", strtotime($row_table['data'])); //Data do envio do documento 
                                                                                ?></td>
                                                            <td data-label=""><?php echo $row_table['pesquisa']; //Horas pesquisa 
                                                                                ?></td>
                                                            <td data-label=""><?php echo $row_table['ensino']; //Horas ensino 
                                                                                ?></td>
                                                            <td data-label=""><?php echo $row_table['extensao']; //Horas ext 
                                                                                ?></td>




                                                            <td class="is-actions-cell">
                                                                <div class="buttons is-right">
                                                                    <button class="button is-small is-primary jb-modal" data-target="<?php echo "h" . $row_table['id'] ?>" type="button">
                                                                        <span class="icon"><i class="mdi mdi-eye"></i></span>
                                                                    </button>
                                                                                                                             </div>
                                                            </td>
                                                    </tr>




                                                    <!-- Modal para ver o doc !-->
                                                    <div id="<?php echo "h" . $row_table['id'] ?>" class="modal">
                                                        <div class="modal-background jb-modal-close"></div>
                                                        <div class="modal-card">
                                                            <header class="modal-card-head">
                                                                <p class="modal-card-title"></p>
                                                                <button class="delete jb-modal-close" aria-label="close"></button>
                                                            </header>
                                                            <section class="modal-card-body">
                                                                <?php if ($ext == 'pdf') { //Se o tipo de arquivo for pdf irá incluir um embed com o mesmo
                                                                ?>

                                                                    <embed src="vendor/docs/<?php echo $row_table['nome'] ?>" style=" position: relative;display: block; padding: 0;overflow: hidden;" frameborder="0" width="100%" height="500px">
                                                                    <p><a href="vendor/docs/<?php echo $row_table['nome'] ?>" target="_blank"> Ou clique aqui para ir para o documento </a> </p>

                                                                <?php } else if ($ext == 'docx') { //Se for um arquivo docx irá oferecer para baixar o arquivo 
                                                                ?>

                                                                    <p><a href="vendor/docs/<?php echo $row_table['nome'] ?>" target="_blank"> Clique aqui para baixar o arquivo </a> </p>

                                                                <?php } else { ?>

                                                                    <div class="image">
                                                                        <img src="vendor/docs/<?php echo $row_table['nome'] ?>">
                                                                    </div>

                                                                <?php } ?>
                                                            </section>
                                                            <footer class="modal-card-foot">
                                                                <button class="button is-danger jb-modal-close">Fechar</button>
                                                            </footer>
                                                        </div>
                                                        <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
                                                    </div>
                                                    <!-- Fim do modal para o número de horas !-->


                                                <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            </footer>

                        </section>
                    </div>
                </div>
            </div>
        </section>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Script principal !-->
        <script type="text/javascript" src="js/main.min.js"></script>
        <!-- Script para mostrar arquivos pdf !-->
        <script src="https://github.com/pipwerks/PDFObject/blob/master/pdfobject.min.js"></script>
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
        
</body>

</html>