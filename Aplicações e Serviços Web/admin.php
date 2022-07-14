<?php
    include "auxiliares/abreconexao.php";
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $query = "SELECT cc , nome, nascimento, carta, genero, email, passwd, telefone, concelho, freguesia, distrito, foto
                FROM voluntario";
    
    $res = mysqli_query($conn, $query);

    $query2 = "SELECT nome, tipo, descricao, email, telefone, concelho, freguesia, distrito, nome_cont, tel_cont
                FROM instituicao";
    
    $res2 = mysqli_query($conn, $query2);

    if ($res) {
        // echo "sucesso";
    } else {
        echo "Erro: failed" . $query . "<br>" . mysqli_error($conn);
    }
    // Termina a ligação com a base de dados
    mysqli_close($conn);

    // header('Location: ../index.html');
?>

<!DOCTYPE html>
<html lang="PT">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMIN - REFOOD FCUL Edition</title>
    <link href="assets/img/brand/icon.png" rel="icon">

    <!-- Custom fonts for this template -->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="assets/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- dataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- css para as tabelas -->
    <link rel="stylesheet" href="auxiliares/admin/tabelas.css">

</head>

<body id="page-top">
    <?php require_once 'process_admin2.php'; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Refood <sup>FCUL</sup></div> -->
                <div class="sidebar-brand-img"><img src="assets/img/brand/logo_white.png"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>PÁGINA PRINCIPAL</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                AÇÕES
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-drumstick-bite"></i>
                    <span>Registar Instituição</span>
                </a>
                <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div> -->
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="registar_voluntario.php" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-users"></i>
                    <span>Registar Voluntário</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="auxiliares/termina_sessao.php">
                    <i class="fa fa-arrow-circle-left"></i>
                    <span>TERMINAR SESSÃO</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div> -->
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small nome_tit">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img/testemonials/admin.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <!-- VER PORQUE É QUE STO NÃO FUNCIONA -->
                            <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div> -->
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->
                            <h1 class="h3 mb-2 text-gray-800">Informação sobre os Utilizadores</h1>
                    <br>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabelas de utilizadores</h6>
                        </div>
                        <div class="card-body">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#volunt" role="tab" aria-controls="volunt" aria-selected="true">Voluntários</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#instit" role="tab" aria-controls="instit" aria-selected="false">Instituições</a>
                                </li>
                              
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="volunt" role="tabpanel" aria-labelledby="volunt-tab">
                                   <br>
                                   
                                    <!-- tabela voluntarios -->
                                    <div class="table-responsive">
                                        <table id="tabela_voluntario" class="cell-border table table-bordered" width="100%" cellspacing=“0”>
                                            <thead>
                                                <tr>
                                                    <!-- <td></td> -->
                                                    <th>Ação</th>
                                                    <th>Nome</th>
                                                    <th>Género</th>
                                                    <th>Data de nascimento</th>
                                                    <th>Cartão de Cidadão</th>
                                                    <th>Carta de Condução</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                    <th>Distrito</th>   
                                                    <th>Concelho</th>
                                                    <th>Freguesia</th>      
                                                </tr>
                                            </thead>
                                            <tfoot style="display: table-header-group;">
                                                <tr>
                                                    <!-- <td></td> -->
                                                    <th>Ação</th>
                                                    <th>Nome</th>
                                                    <th>Género</th>
                                                    <th>Data de nascimento</th>
                                                    <th>Cartão de Cidadão</th>
                                                    <th>Carta de Condução</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                    <th>Distrito</th>   
                                                    <th>Concelho</th>
                                                    <th>Freguesia</th>       
                                                </tr>
                                                </tfoot>
                                            <tbody id="table_body">
                                                <?php 
                                                    while($row = $res-> fetch_assoc()){
                                                ?>
                                                    <tr>
                                                        <!-- <td></td> -->
                                                        <td>
                                                            <a href="admin.php?edit=<?php echo $row['cc'] ?>"
                                                                class="btn btn-info">Editar</a>
                                                            <a href="process_admin2?delete=<?php echo $row['cc'] ?>"
                                                                class="btn btn-danger">Eliminar</a>
                                                        </td>
                                                        <td><?php echo $row['nome']; ?></td>
                                                        <td><?php echo $row['genero']; ?></td>
                                                        <td><?php echo $row['nascimento']; ?></td>
                                                        <td><?php echo $row['cc']; ?></td>
                                                        <td><?php echo $row['carta']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['telefone']; ?></td>
                                                        <td><?php echo $row['distrito']; ?></td>
                                                        <td><?php echo $row['concelho']; ?></td>
                                                        <td><?php echo $row['freguesia']; ?></td>
                                                    </tr>
                                                <?php 
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="instit" role="tabpanel" aria-labelledby="instit-tab">

                                    <br>
                                   
                                    <!-- tabela instituicao -->
                                    <div class="table-responsive">
                                        <table id="tabela_instituicao" class="cell-border table table-bordered" width="100%" cellspacing=“0”>
                                            <thead>
                                                <tr>
                                                    <th>Horário</th>
                                                    <th>Nome</th>
                                                    <th>Tipo</th>
                                                    <th>Descrição</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                    <th>Concelho</th>
                                                    <th>Freguesia</th>
                                                    <th>Distrito</th>
                                                    <th>Pessoa de contacto</th>
                                                    <th>Telefone contacto</th>
                                                </tr>
                                            </thead>
                                            <tfoot style="display: table-header-group;">
                                                <tr>
                                                    <th></th>
                                                    <th>Nome</th>
                                                    <th>Tipo</th>
                                                    <th>Descrição</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                    <th>Concelho</th>
                                                    <th>Freguesia</th>
                                                    <th>Distrito</th>
                                                    <th>Pessoa de contacto</th>
                                                    <th>Telefone contacto</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            
            
            <table>
            <div class="row justify-content-center">
                <form action="process_admin2.php" method="POST">


                <tr>
                <td>
                    <div class="form-group">
                        <label class="tabela">CC</label>
                        <input type="text" name="cc" class="form-control" value="<?php echo $cc; ?>"
                            placeholder="Ex: 12345678">
                    </div>
                </td>
                <td>                                    
                    <div class="form-group">
                        <label class="tabela">Name</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>"
                            placeholder="Ex: Joana">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label class="tabela">Nascimento</label>
                        <input type="text" name="nascimento" class="form-control" value="<?php echo $nascimento; ?>"
                            placeholder="Ex: 1995-04-25">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label class="tabela">Carta de condução</label>
                        <input type="text" name="carta" class="form-control" value="<?php echo $carta; ?>"
                            placeholder="Ex: 12345678">
                    </div>
                </td>
                </tr>
                <tr>
                <td>
                    <div class="form-group">
                        <label class="tabela">Género</label>
                        <input type="text" name="genero" class="form-control" value="<?php echo $genero; ?>"
                            placeholder="M/F/O">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label class="tabela">Email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"
                            placeholder="Ex: joana02@gmail.com">
                    </div>
                </td>                                    
                <td>
                    <div class="form-group">
                        <label class="tabela">Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="<?php echo $telefone; ?>"
                            placeholder="916778345">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label class="tabela">Passwd</label>
                        <input type="text" name="passwd" class="form-control" value="<?php echo $passwd; ?>"
                            placeholder="Ex: pass123">
                    </div>
                </td>
                </tr>
                <tr>
                <td>
                    <div class="form-group">
                        <label class="tabela">Concelho</label>
                        <input type="text" name="concelho" class="form-control" value="<?php echo $concelho; ?>"
                            placeholder="Ex: Marvila">
                    </div>
                </td>
                <td>    
                    <div class="form-group">
                        <label class="tabela">Freguesia</label>
                        <input type="text" name="freguesia" class="form-control" value="<?php echo $freguesia; ?>"
                            placeholder="Ex: Lisboa ">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label class="tabela">Distrito</label>
                        <input type="text" name="distrito" class="form-control" value="<?php echo $distrito; ?>"
                            placeholder="Ex: Lisboa">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <?php
                            if ($update == true):
                        ?>
                        <button type="submit" class="btn btn-info" name="update">Atualizar</button>
                        <?php else: ?>
                        <button type="submit" class="btn btn-primary" name="save">Registar</button>
                        <?php endif; ?>
                    </div>
                </form>
                </td>
                
            </div>
            
            </tr>
                </table>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">                        
                        &copy; Copyright <strong><span>Refood-FCUL</span></strong>. All Rights Reserved
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <!-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->

    <!-- Logout Modal-->
    <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
    <script src="assets/vendor/jquery/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <!-- <script src="js/sb-admin-2.min.js"></script> -->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
    <script src="assets/css/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/css/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/datatables-demo.js"></script> -->
    <script src="assets/js/datatables-demo.js"></script>

</body>

</html>

<script>
    // Trocar entre as tabelas
    $('#myTab a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })



    function format_instituicao(d) {
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>Segunda:</td>' +
            '<td>' + d.horario.segunda + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Terca:</td>' +
            '<td>' + d.horario.terca + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Quarta:</td>' +
            '<td>' + d.horario.quarta + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Quinta:</td>' +
            '<td>' + d.horario.quinta + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Sexta:</td>' +
            '<td>' + d.horario.sexta + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Sabado:</td>' +
            '<td>' + d.horario.sabado + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Domingo:</td>' +
            '<td>' + d.horario.domingo + '</td>' +
            '</tr>' +
            '</table>';
    }

    $(document).ready(function () {
        // Caixas de pesquisa tabela voluntario
        $('#tabela_voluntario tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Procurar ' + title + '" />');
        });

        // Caixas de pesquisa tabela instituicao
        i = 0;
        $('#tabela_instituicao tfoot th').each(function () {
            var title = $(this).text();
            if (i == 0) {
                $(this).html('<p>  </p>');
            } else {
                $(this).html('<input type="text" placeholder="Procurar ' + title + '" />');
            }
            i++;
        });

        // Tabela Voluntário
        var tabelaVoluntario = $('#tabela_voluntario').DataTable({
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-PT.json"
            }
        });

        // Tabela Instituicao
        var tabelaInstituicao = $('#tabela_instituicao').DataTable({
            ajax: {
                url: 'auxiliares/admin/instituicao-admin.php',
                dataSrc: 'instituicao'
            },
            columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { data: "nome" },
                { data: "tipo" },
                { data: "descricao" },
                { data: "email" },
                { data: "telefone" },
                { data: "concelho" },
                { data: "freguesia" },
                { data: "distrito" },
                { data: "nome_cont" },
                { data: "tel_cont" }
            ],
            order: [[1, 'asc']],
            initComplete: function () {
                this.api().columns().every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-PT.json"
            }
        });

        // Horario instituicoes
        $('#tabela_instituicao tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = tabelaInstituicao.row(tr);

            if (row.child.isShown()) {
                // fecha a linha
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // expande a linha
                if (row.data().horario.segunda == undefined) {
                    row.child('<p>Horário de disponíbilidade ainda não definido.</p>').show();
                    tr.addClass('shown');
                } else {
                    row.child(format_instituicao(row.data())).show();
                    tr.addClass('shown');
                }
            }
        });

    });

// let input = document.querySelector(".input");
// let button = document.querySelector(".button");

// button.disabled = false; //setting button state to disabled

// input.addEventListener("change", stateHandle);

// function stateHandle() {
//     if (document.querySelector(".input").value === "") {
//         button.disabled = false; //button remains disabled
//         console.log("disable");
//     } else {
//         button.disabled = true; //button is enabled
//         console.log("nao disable");
//     }
// }
</script>
