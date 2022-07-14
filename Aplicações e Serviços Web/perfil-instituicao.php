<?php
    include "auxiliares/abreconexao.php";

    $parts = parse_str($_SERVER['QUERY_STRING'], $get_array);
    
    $strQuery = $get_array['id'];
    $query = "SELECT * FROM instituicao WHERE email = '$strQuery'";
    
    $res = mysqli_query($conn, $query);

    if ($res) {
    } else {
        echo "Erro: failed" . $query . "<br>" . mysqli_error($conn);
    }
    // Termina a ligação com a base de dados
    mysqli_close($conn);

    session_start();
    if (isset($_SESSION["login"])){
			echo "<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'> </script>
				<script>
				function updateUserStatus(){
				console.log('Hello world2!');
				jQuery.ajax({
					url:'/~asw14/projeto/TestesPedro/Proj/chat2/update_user_status.php',
					success:function(){
					
					}
				});
				}
			
				setInterval(function(){
				updateUserStatus();
				},3000);
		    </script>";
    }
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PERFIL INSTITUICAO - REFOOD FCUL Edition</title>
  <link href="assets/img/brand/icon.png" rel="icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.php" class="logo me-auto"><img src="assets/img/brand/logo.png" alt=""></a>
 
      <!-- ======= Navbar ======= -->
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto nav-active" href="index.php">Página Principal</a></li>
          <li><a class="nav-link scrollto" href="instituicoes.php">Instituições</a></li>
          <li class="dropdown"><a href="#"><span>Sobre nós</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="contactos.php">Contactos</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
      <a href="login.php" class="login-btn scrollto"><span class="d-none d-md-inline">Entrar/</span>Registar</a>
    </div>
  </header>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact pb-0">
      <div class="container">
        <img class="instit_img" src="assets/img/institutions/instituicao.jpg">
        <div class="section-title-contact">
          <?php  
            $row = $res-> fetch_assoc();
          ?>
          <h2><?php echo $row['nome'];?></h2>
          <script>
            console.log(<?= json_encode($strQuery); ?>);
          </script>
          <p><?php echo $row['descricao'];?></p>
        </div>

      </img>

      <div class="container px-4 py-4" id="hanging-icons">
        <h2 class="pb-2 border-bottom">Informações</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
          <div class="col d-flex align-items-start">
            <div class="icon-square text-dark flex-shrink-0 me-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-pin-map"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z">
                </path>
                <path fill-rule="evenodd"
                  d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z">
                </path>
              </svg>
            </div>
            <div>
              <h2>Morada</h2>
              <p><?php echo $row['morada'];?><br>
              <em><?php echo $row['concelho'];?>, <?php echo $row['distrito'];?></em> </p>
              
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <div class="icon-square text-dark flex-shrink-0 me-3">
              <i class="fa fa-phone" aria-hidden="true" width="2em" height="2em"></i>
            
            </div>
            <div>
              <h2>Contactos</h2>
              <p><strong>E-mail:</strong> <?php echo $row['email'];?><br>
                 <strong>Telefone: </strong> <?php echo $row['telefone'];?></p>
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <div class="icon-square text-dark flex-shrink-0 me-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor"
                class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path
                  d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
              </svg>
            </div>
            <div>
              <h2>Pessoa de contacto</h2>
              <p><strong>Nome: </strong><?php echo $row['nome_cont'];?><br><strong>Telefone: </strong><?php echo $row['tel_cont'];?></p>
            </div>
          </div>
        </div>
      </div>

      </div>

      </div>
    </section>
    <!-- End Contact Section -->
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Refood-FCUL</h3>
              <p>
                R. Manuel Mendes,<br>
                Lote 20 Cave D, 1800-251 Lisboa<br><br>
                <strong>Telefone:</strong> 961 472 340<br>
                <strong>Email:</strong> refood-fcul@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Página Principal</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="instituicoes.php">Instituições</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Sobre nós</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="contactos.php">Contactos</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 footer-newsletter">
            <img class="footerImg" src="assets/img/brand/Cofinanciamento_Lisboa2020_Portugal2020.png" > 
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Refood-FCUL</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>
  <!-- End Footer -->
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<style>
  .instit_img{
    display: block;
    margin: auto;
    margin-bottom: -100px;
    margin-top: 100px;
    height: 40vh;
    width: auto;
  }
</style>