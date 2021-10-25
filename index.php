<?php
include "./config/conexao.php"; //Arquivo para conexão com o banco de dados Mysql
?>

<!DOCTYPE html>
<html lang="pt-Br" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver alunos</title>

    <!-- Bulma  -->
    <link rel="stylesheet" href="css/main.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app">
        <nav id="navbar-main" class="navbar is-fixed-top">
            <div class="navbar-brand is-right">
                <a class="navbar-item is-hidden-desktop jb-navbar-menu-toggle" data-target="navbar-menu">
                    <span class="icon"><i class="mdi mdi-dots-vertical"></i></span>
                </a>
            </div>
            <div class="navbar-menu fadeIn animated faster" id="navbar-menu">
                <div class="navbar-end">
                    <div class="navbar-item has-dropdown has-dropdown-with-icons has-divider has-user-avatar is-hoverable">
                        <a class="navbar-link is-arrowless">
                            <div class="is-user-avatar">
                                <img src="https://avatars.dicebear.com/v2/initials/Secretario.svg" alt="John Doe">
                            </div>
                            <div class="is-user-name"><span>Secretario</span></div>
                            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
                        </a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-account"></i></span>
                                <span>Conta</span>
                            </a>
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-settings"></i></span>
                                <span>Configurações</span>
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-logout"></i></span>
                                <span>Sair</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <?php include "./config/side_bar.php"; //Adiciona o menu lateral ?>

        <section class="hero is-hero-bar">
            <div class="hero-body">
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <h1 class="title">
                            <span class="icon"><i class="fas fa-user-friends"></i></span> Alunos
                            </h1>
                        </div>
                    </div>
                    <div class="level-right" style="display: none;">
                        <div class="level-item"></div>
                    </div>
                </div>
            </div>
        </section>
        <div id='loadApp'>
            <section class="section is-main-section">
                <div class="card has-table">
                    <header class="card-header">
                        <p class="card-header-title">
                            <span class="icon"><i class="fas fa-user-friends"></i></span>
                              Alunos
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
                                            <th> </th>
                                            <th>Nome</th>
                                            <th>Curso</th>
                                            <th>Nº de de matrícula</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $sql_alunos = $sqli->query("SELECT * FROM alunos ");  //Seleciona os documentos pertencentes ao atual aluno
                                            while ($row_table = $sql_alunos->fetch_assoc()) { // Lista os documentos na tabela
                                                $nome_limpo = str_replace(" ", "-", $row_table['nome']); //Retira os espaços em branco no nome para o mesmo poder se colocado nas url's de imagem
                                            ?>

                                                <td class="is-image-cell">
                                                    <div class="image">
                                                        <img src="https://avatars.dicebear.com/v2/initials/<?php echo $nome_limpo ?>.svg" class="is-rounded" alt="Image">
                                                    </div>
                                                </td>
                                                <td data-label="Comany"><?php echo $row_table['nome']; //Nome aluno ?></td>
                                                <td data-label=""><?php echo $row_table['curso']; //Curso  ?></td>
                                                <td data-label=""><?php echo $row_table['matricula']; //Numero de matricula ?></td>


                                                <td class="is-actions-cell">
                                                    <div class="buttons is-right">
                                                        <a href="aluno.php?id=<?php echo $row_table['id']; ?>">
                                                            <button class="button is-small is-primary jb-modal"  type="button">
                                                                <span class="icon"><i class="mdi mdi-eye"></i></span>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                        </tr>



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

        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Script principal !-->
        <script type="text/javascript" src="js/main.min.js"></script>
        <!-- Script para mostrar arquivos pdf !-->
        <script src="https://github.com/pipwerks/PDFObject/blob/master/pdfobject.min.js"></script>
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>