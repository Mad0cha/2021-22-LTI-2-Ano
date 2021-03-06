<?php
    include "forms/abreconexao.php";
    $query = "SELECT cc , nome, nascimento, carta, genero, email, passwd, telefone, concelho, freguesia, distrito
                FROM voluntario";
    
    $res = mysqli_query($conn, $query);

    $query2 = "SELECT nome, tipo, descricao, email, passwd, telefone, concelho, freguesia, distrito, nome_cont, tel_cont
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
<html lang="en">

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

    <!-- Custom styles for this page -->
    <!-- <link href="ass/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <link href="assets/css/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Refood <sup>FCUL</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Página principal</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
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
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
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
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
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
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin Refood</span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img/brand/icon.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <!-- VER PORQUE É QUE STO NÃO FUNCIONA -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
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
                            </div>
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
                    <h1 class="h3 mb-2 text-gray-800">Utilizadores</h1>
                    <br>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->


                    <!-- DataTales Example -->
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
                                   
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Cartão de Cidadão</th>
                                                    <th>Nome</th>
                                                    <!-- <th>Apelido</th> -->
                                                    <th>Data de nascimento</th>
                                                    <th>Carta de Condução</th>
                                                    <th>Género</th>
                                                    <th>Email</th>
                                                    <th>Password</th> 
                                                    <th>Telefone</th>
                                                    <th>Concelho</th>
                                                    <th>Freguesia</th>
                                                    <th>Distrito</th>        
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="th-lighter">Cartão de Cidadão</th>
                                                    <th class="th-lighter">Nome</th>
                                                    <!-- <th>Apelido</th> -->
                                                    <th class="th-lighter">Data de nascimento</th>
                                                    <th class="th-lighter">Carta de Condução</th>
                                                    <th class="th-lighter">Género</th>
                                                    <th class="th-lighter">Email</th>
                                                    <th class="th-lighter">Password</th> 
                                                    <th class="th-lighter">Telefone</th>
                                                    <th class="th-lighter">Concelho</th>
                                                    <th class="th-lighter">Freguesia</th>
                                                    <th class="th-lighter">Distrito</th>
                                                </tr>
                                            </tfoot>
                                            <tbody id="table_body">
                                            <?php 
                                                while($row = $res-> fetch_assoc()){
                                            ?>  
                                                <tr>
                                                    <td><?php echo $row['cc']; ?></td>
                                                    <td><?php echo $row['nome']; ?></td>
                                                    <td><?php echo $row['nascimento']; ?></td>
                                                    <td><?php echo $row['carta']; ?></td>
                                                    <td><?php echo $row['genero']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['passwd']; ?></td>
                                                    <td><?php echo $row['telefone']; ?></td>
                                                    <td><?php echo $row['concelho']; ?></td>
                                                    <td><?php echo $row['freguesia']; ?></td>
                                                    <td><?php echo $row['distrito']; ?></td>
                                                </tr>
                                            <?php 
                                               }
                                            ?>  
                                            <!-- <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>Ashton Cox</td>
                                                <td>Junior Technical Author</td>
                                                <td>San Francisco</td>
                                                <td>66</td>
                                                <td>2009/01/12</td>
                                                <td>$86,000</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                            </tr> -->
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="instit" role="tabpanel" aria-labelledby="instit-tab">

                                    <br>
                                   
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <!-- <th>Apelido</th> -->
                                                    <th>Tipo</th>
                                                    <th>Descrição</th>
                                                    <th>Email</th>
                                                    <th>Password</th> 
                                                    <th>Telefone</th>
                                                    <th>Concelho</th>
                                                    <th>Freguesia</th>
                                                    <th>Distrito</th>
                                                    <th>Pessoa de contacto</th> 
                                                    <th>Telefone contacto</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="th-lighter">Nome</th>
                                                    <!-- <th>Apelido</th> -->
                                                    <th class="th-lighter">Tipo</th>
                                                    <th class="th-lighter">Descrição</th>
                                                    <th class="th-lighter">Email</th>
                                                    <th class="th-lighter">Password</th> 
                                                    <th class="th-lighter">Telefone</th>
                                                    <th class="th-lighter">Concelho</th>
                                                    <th class="th-lighter">Freguesia</th>
                                                    <th class="th-lighter">Distrito</th>
                                                    <th class="th-lighter">Pessoa de contacto</th> 
                                                    <th class="th-lighter">Telefone contacto</th>
                                                </tr>
                                            </tfoot>
                                            <tbody id="table_body">
                                            <?php 
                                                while($row2 = $res2-> fetch_assoc()){
                                            ?>  
                                                <tr>
                                                    <td><?php echo $row2['nome']; ?></td>
                                                    <td><?php echo $row2['tipo']; ?></td>
                                                    <td><?php echo $row2['descricao']; ?></td>
                                                    <td><?php echo $row2['email']; ?></td>
                                                    <td><?php echo $row2['passwd']; ?></td>
                                                    <td><?php echo $row2['telefone']; ?></td>
                                                    <td><?php echo $row2['concelho']; ?></td>
                                                    <td><?php echo $row2['freguesia']; ?></td>
                                                    <td><?php echo $row2['distrito']; ?></td>
                                                    <td><?php echo $row2['nome_cont']; ?></td>
                                                    <td><?php echo $row2['tel_cont']; ?></td>
                                                </tr>
                                            <?php 
                                               }
                                            ?>  
                                            <!-- <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>Ashton Cox</td>
                                                <td>Junior Technical Author</td>
                                                <td>San Francisco</td>
                                                <td>66</td>
                                                <td>2009/01/12</td>
                                                <td>$86,000</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                                <td>$320,800</td>
                                            </tr> -->
                                            </tbody>
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
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    </div>

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
    <script src="js/demo/datatables-demo.js"></script>
    <script src="assets/js/datatables-demo.js"></script>
    
    

</body>

</html>

<script>
    $('#myTab a').on('click', function (e) {
        e.preventDefault()
            $(this).tab('show')
    })
</script>